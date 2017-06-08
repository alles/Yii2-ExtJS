/**
 * This view is an example list of promo codes.
 */
Ext.define('InviteCode.view.main.List', {
    extend: 'Ext.grid.Panel',
    xtype: 'mainlist',

    requires: [
        'Ext.grid.column.Action',
        'Ext.button.Button',
        'Ext.grid.plugin.CellEditing'
    ],

    title: 'Promo codes',

    plugins: {
        ptype: 'cellediting',
        clicksToEdit: 2
    },

    bind: {store: '{promoCodes}'},

    reference: 'list',
    enableColumnHide: false,
    enableColumnMove: false,
    enableColumnResize: false,
    sortableColumns: false,
    columnLines: true,

    columns: [
        { text: 'ID',  dataIndex: 'id', width: 40 },
        { text: 'Start Date', dataIndex: 'start_date', width: 90, editor: {xtype: 'textfield'}},
        { text: 'End Date', dataIndex: 'end_date', width: 90, editor: {xtype: 'textfield'} },
        { text: 'Fee',  dataIndex: 'fee', flex: 1, editor: {xtype: 'textfield'} },
        { text: 'Tariff zone',  dataIndex: 'id_cities', flex: 2, editor: {
            xtype: 'combo',
            forceSelection: true,
            editable: false,
            bind: {store: '{cities}'},
            queryMode: 'local',
            displayField: 'name',
            valueField: 'id',
            name: 'id_cities',
            triggerAction: 'all',
            listeners: {
                change: 'onChangeCity'
            }
        }, renderer: function (val, el, rec, row, col, store, grid) {
            return grid.lookupViewModel().get('cities').getById(val).get('name');
        }},
        { text: 'Status', dataIndex: 'status', width: 70, editor: {xtype: 'textfield'} },
        { xtype: 'widgetcolumn', text: 'Info action', widget: {
            xtype: 'button',
            text: 'Get Discount Info',
            bind: {
                ariaAttributes: '{record.name}'
            },
            handler: 'onGridButtonClick'
        }, width: 140},
        { xtype: 'widgetcolumn', text: 'Activate action', widget: {
            xtype: 'button',
            text: 'Activate discount',
            bind: {
                ariaAttributes: '{record.name}'
            },
            handler: 'onGridButtonClick'
        }, width: 140}
    ]
});
