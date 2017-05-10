export default {
    appLoading: false, //State for defining if the app is in a global loading stage or not
    menu: [ //Menu to render in navigation bar
        { name: 'home', route: 'page.home' },
        { divider: true }, //Menu Divider
        { name: 'demo', menu: [
            { name: 'events', route: 'demo.events' },
            { name: 'parallax', route: 'demo.parallax' },
            { divider: true }, //Menu Divider
            { name: 'selectize', route: 'demo.selectize' },
            { name: 'tinymce', route: 'demo.tinymce' }
        ]}
    ],
    guestMenu: [ //Menu only available for guests
        { name: 'login', route: 'auth.login', position: 'right' }
    ],
    authMenu: [ //Menu only available for authenticated users
        { name: 'logout', route: 'auth.logout', position: 'right' }
    ]
}