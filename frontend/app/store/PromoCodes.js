Ext.define('InviteCode.store.PromoCodes', {
    extend: 'Ext.data.Store',
    alias: 'store.promoCodes',

    requires: [
        'Ext.window.MessageBox'
    ],

    fields: ['id', 'fee', 'start_date', 'end_date', 'status', 'city'],

    autoLoad: false,
    autoSync: true,

    proxy: {
        type: 'rest',
        url: '/api/promo-codes',
        reader: {
            type: 'json',
            rootProperty: 'data'
        }
    },

    constructor: function () {
        this.callParent(arguments);

        this.getProxy().on('exception', this.onException, this);
    },

    onException: function (proxy, resp, operation) {
        var data = Ext.JSON.decode(resp.responseText).data;
        if (Ext.isObject(data)) data = [data];

        var msg = '<ul>';
        Ext.Array.each(data, function (val) {
            msg += '<li>' + val.message + '</li>';
        }, this);
        msg += '</ul>';

        if (operation.isCreateOperation) {
            this.remove(operation.getRecords());
        } else {
            operation.getRecords()[0].reject();
        }

        Ext.Msg.show({
            title: resp.statusText,
            message: msg,
            icon: Ext.Msg.ERROR
        });
    },

    sendAjaxRequest: function (action, params, success) {
        Ext.Ajax.request({
            url: this.getProxy().getUrl() + '/' + action,
            method: 'get',
            params: params,
            success: success,

            failure: function(resp) {
                var data = Ext.JSON.decode(resp.responseText).data;

                Ext.Msg.show({
                    title: resp.statusText,
                    message: data.message,
                    icon: Ext.Msg.ERROR
                });
            },

            scope: this
        });
    },

    getDiscountInfo: function (name) {
        this.sendAjaxRequest('get_discount_info', {name: name}, function (resp) {
            var msg = '<ul>';
            Ext.Object.each(Ext.JSON.decode(resp.responseText).data, function (key, val) {
                msg += '<li>' + key + ': ' + val + '</li>';
            }, this);
            msg += '</ul>';

            Ext.Msg.alert('Get discount information "' + name + '"', msg);
        });
    },

    activateDiscount: function (id, name, id_cities) {
        this.sendAjaxRequest('activate_discount', {name: name, id_cities: id_cities}, function (resp) {
            this.suspendAutoSync();
            this.getById(id).set('status', 'active', {commit: true});
            this.resumeAutoSync();
            Ext.Msg.alert('Activate discount "' + name + '"', 'Fee = ' + Ext.JSON.decode(resp.responseText).data);
        });
    }
});
