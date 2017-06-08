Ext.define('InviteCode.view.main.MainModel', {
    extend: 'Ext.app.ViewModel',

    requires: [
        'InviteCode.store.PromoCodes',
        'InviteCode.store.Cities'
    ],

    alias: 'viewmodel.main',

    stores: {
        promoCodes: {
            type: 'promoCodes'
        },
        cities: {
            type: 'cities'
        }
    }
});