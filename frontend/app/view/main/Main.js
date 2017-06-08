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

        'InviteCode.view.main.MainController',
        'InviteCode.view.main.MainModel',
        'InviteCode.view.main.List',
        'InviteCode.view.main.Form'
    ],

    controller: 'main',
    viewModel: 'main',

    layout: 'hbox',

    items: [{
        xtype: 'mainlist',
        flex: 1
    }, {
        xtype: 'mainform',
        margin: '0 10',
        width: 300
    }]
});
