/**
 * This class is the main view for the application. It is specified in app.js as the
 * "mainView" property. That setting automatically applies the "viewport"
 * plugin causing this view to become the body element (i.e., the viewport).
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('InviteCode.view.main.Main', {
    extend: 'Ext.panel.Panel',
    xtype: 'app-main',

    requires: [
        'Ext.plugin.Viewport',
        'Ext.window.MessageBox',
        'Ext.container.Container',

        'InviteCode.view.main.MainController',
        'InviteCode.view.main.MainModel',
        'InviteCode.view.main.List',
        'InviteCode.view.main.Form'
    ],

    controller: 'main',
    viewModel: 'main',

    items: [{
        xtype: 'container',
        width: '100%',
        html: [
            '<ul>',
                '<li>Please double click on the cell to edit the table</li>',
                '<li>Format date = Y-m-d (ex. 2017-10-10)</li>',
            '</ul>'
        ].join(''),
        style: {
            background: '#e2e2e2'
        },
        margin: '0 0 10 0'
    }, {
        xtype: 'container',
        layout: 'hbox',
        items: [{
            xtype: 'mainlist',
            margin: '0 5 0 10',
            flex: 1
        }, {
            xtype: 'mainform',
            margin: '0 10 0 5',
            width: 300
        }]
    }]
});
