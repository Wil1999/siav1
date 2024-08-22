function toggleLeftPanel() {
    const panelControlButton = $('.panelControl_button');
    const panelControl = $('.panelControl')
    const panelControlDetails = $('.panelControl_details')

    panelControlButton.on('click', function (e) {
        $(this).toggleClass('collapsed')
        panelControl.toggleClass('collapsed')
    })
}

toggleLeftPanel();


function toogleMenu(_this) {

    const menuUl = document.querySelectorAll('.menu-ul>li')
    let parent = _this.parentElement;

    if (parent.getElementsByTagName('ul').length > 0) {
        let liMenu = parent.getElementsByTagName('ul')[0]

        menuUl.forEach(el => {
            if (el.getElementsByTagName('ul').length > 0) {
                el.style.display = '';
            }
        })

        if (liMenu.style.display == 'block') {
            liMenu.style.display = 'none';
        } else {
            liMenu.style.display = 'block';
        }
    }
}

function toogleSubMenu(_this) {
    const menuUl = document.querySelectorAll('.sub-menus-ul>li')
    let parent = _this.parentElement;

    if (parent.getElementsByTagName('ul').length > 0) {
        let liMenu = parent.getElementsByTagName('ul')[0]

        menuUl.forEach(el => {
            if (el.getElementsByTagName('ul').length > 0) {
                el.style.display = '';
            }
        })

        if (liMenu.style.display == 'block') {
            liMenu.style.removeProperty('display');
        } else {
            liMenu.style.display = 'block';
        }
    }
}

function toogleMenuModal() {
    //const modalServicesMenu = $('.modalServices_menu')
    const sitemenu = $('.site-menu')
    sitemenu.toggle()
}


function toogleSubMenuModal() {
    const modalServicesSubMenu = $('.modalServices_sub-menu')
    modalServicesSubMenu.toggle()
}

function toogleModalMap() {
    const panelControl_details = $('.panelControl_details');
    const panelControl_tab_info = $('.panelControl_tab-info')
    const panelControl_tab_services = $('.panelControl_tab-services')

    const panelControl = $('.panelControl')
    const panelControlButton = $('.panelControl_button');

    panelControl.removeClass('collapsed')
    panelControlButton.removeClass('collapsed')

    panelControl_details.show();
    panelControl_tab_info.hide();
    panelControl_tab_services.hide()
}

function toogleModalServices() {
    const panelControl_details = $('.panelControl_details');
    const panelControl_tab_info = $('.panelControl_tab-info')
    const panelControl_tab_services = $('.panelControl_tab-services')

    const panelControl = $('.panelControl')
    const panelControlButton = $('.panelControl_button');

    panelControl.removeClass('collapsed')
    panelControlButton.removeClass('collapsed')

    panelControl_details.hide();
    panelControl_tab_info.hide();
    panelControl_tab_services.show()

    /*
    const leftPanel = document.getElementsByClassName('left-panel')[0];
    const mobileServicesTab = document.getElementsByClassName('mobile-services-tab')[0];
    const mobileInfoTab = document.getElementsByClassName('mobile-info-tab')[0];

    let compStylesLeftPanel = window.getComputedStyle(leftPanel);
    let compStylesMobileServicesTab = window.getComputedStyle(mobileServicesTab);

    if (leftPanel.className.includes('services-show')) {
        leftPanel.classList.remove('services-show')
        leftPanel.classList.remove('info-show')
        mobileServicesTab.style.display = 'none'
    } else {
        leftPanel.classList.add('services-show')
        leftPanel.classList.remove('info-show')
        mobileServicesTab.style.display = 'unset'
        mobileInfoTab.style.display = 'none'
    }
    */
    /*
    leftPanel.style.display = compStylesLeftPanel.getPropertyValue('display') == 'none' ? 'flex' : 'none';
    mobileInfoTab.style.display = compStylesMobileInfoTab.getPropertyValue('display') == 'none' ? 'unset' : 'none';
    */
}

function toogleModalAboutUs() {
    const panelControl_details = $('.panelControl_details');
    const panelControl_tab_services = $('.panelControl_tab-services')
    const panelControl_tab_info = $('.panelControl_tab-info')

    const panelControl = $('.panelControl')
    const panelControlButton = $('.panelControl_button');

    panelControl.removeClass('collapsed')
    panelControlButton.removeClass('collapsed')

    panelControl_details.hide();
    panelControl_tab_services.hide()
    panelControl_tab_info.show();
    /*
    const leftPanel = document.getElementsByClassName('left-panel')[0];
    const mobileInfoTab = document.getElementsByClassName('mobile-info-tab')[0];
    const mobileServicesTab = document.getElementsByClassName('mobile-services-tab')[0];

    let compStylesLeftPanel = window.getComputedStyle(leftPanel);
    let compStylesMobileInfoTab = window.getComputedStyle(mobileInfoTab);

    if (leftPanel.className.includes('info-show')) {
        leftPanel.classList.remove('info-show')
        leftPanel.classList.remove('services-show')

        mobileInfoTab.style.display = 'none'
    } else {
        leftPanel.classList.add('info-show')
        leftPanel.classList.remove('services-show')

        mobileInfoTab.style.display = 'unset'
        mobileServicesTab.style.display = 'none'
    }
    */
    /*
    leftPanel.style.display = compStylesLeftPanel.getPropertyValue('display') == 'none' ? 'flex' : 'none';
    mobileInfoTab.style.display = compStylesMobileInfoTab.getPropertyValue('display') == 'none' ? 'unset' : 'none';
    */
}

function toogleAboutUs() {
    const aboutUsPanel = $('#aboutUsPanel')
    aboutUsPanel.toggle()
}