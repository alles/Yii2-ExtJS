Ext.define('InviteCode.store.Cities', {
    extend: 'Ext.data.Store',
    alias: 'store.cities',

    fields: ['id', 'name'],

    autoLoad: true,

    proxy: {
        type: 'ajax',
        url: '/api/cities',
        reader: {
            type: 'json',
            rootProperty: 'data'
        }
    }
});
