/**
 * This view is an example form of promo code.
 */
Ext.define('InviteCode.view.main.Form', {
    extend: 'Ext.form.Panel',
    xtype: 'mainform',

    requires: [
        'Ext.form.FieldSet',
        'Ext.form.field.Text'
    ],

    title: 'Create promo code',
    reference: 'form',

    defaults: {
        fieldDefaults: {
            labelAlign: 'right'
        }
    },

    items: [{
        xtype: 'fieldset',
        title: 'Date info',
        items: [{
            xtype: 'textfield',
            fieldLabel: 'From',
            name: 'start_date'
        }, {
            xtype: 'textfield',
            fieldLabel: 'To',
            name: 'end_date'
        }]
    }, {
        xtype: 'fieldset',
        title: 'Main information',
        items: [{
            xtype: 'textfield',
            fieldLabel: 'Name',
            name: 'name'
        }, {
            xtype: 'textfield',
            fieldLabel: 'Fee',
            name: 'fee'
        }, {
            xtype: 'combobox',
            fieldLabel: 'Tariff zone',
            forceSelection: true,
            editable: false,
            bind: {store: '{cities}'},
            queryMode: 'local',
            displayField: 'name',
            valueField: 'id',
            name: 'id_cities'
        }]
    }],

    buttons: [{
        text: 'Create',
        disabled: true,
        formBind: true,
        handler: 'onCreatePromoCode'
    }]
});
