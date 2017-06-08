/**
 * This class is the controller for the main view for the application. It is specified as
 * the "controller" of the Main view class.
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('InviteCode.view.main.MainController', {
    extend: 'Ext.app.ViewController',

    alias: 'controller.main',

    init: function () {
        this.getViewModel().getStore('cities').on('load', function () {
            this.getViewModel().getStore('promoCodes').load();
        }, this);
    },

    onCreatePromoCode: function () {
        var form = this.lookupReference('form'),
            store = this.lookupReference('list').getStore();

        store.add(form.getValues());
    },

    onGridButtonClick: function (btn) {
        var rec = btn.lookupViewModel().get('record'),
            store = this.lookupReference('list').getStore();

        if (btn.getText() == 'Get Discount Info') {
            store.getDiscountInfo(rec.get('name'));
        } else {
            store.activateDiscount(rec.id, rec.get('name'), rec.get('id_cities'));
        }
    },

    onChangeCity: function (el, val) {
        var store = this.getViewModel().getStore('promoCodes');
    }
});
