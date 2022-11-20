class ContaoCollapsibleSidebar {

    id = null;
    togglers = null
    sidebar = null;
    body = null;
    toggleSidebarEvent = null;

    constructor(id) {
        this.id = id;

        if (!this.id) {
            console.error('No ID added to the constructor!');
            return;
        }

        this.initialize();
    }

    initialize() {
        this.togglers = document.querySelectorAll('.collapsible-sidebar-toggle[aria-controls="' + this.id + '"]')
        this.sidebar = document.getElementById(this.id);
        this.body = document.querySelector('body');
        this.toggleSidebarEvent = new CustomEvent('toggle-sidebar', {});

        if (!this.body) {
            console.error('No body tag found!');
            return;
        }

        if (!this.togglers.length) {
            console.error('No toggler for collapsing the sidebar found!');
            return;
        }

        if (!this.sidebar) {
            console.error('No sidebar element with ID ' + this.id + 'found!');
            return;
        }

        /**
         * Dispatch the toggle-sidebar event,
         * if user clicks a  *[class="collapsible-sidebar-toggle"] button
         */
        for (let i = 0; i < this.togglers.length; i++) {
            this.togglers[i].addEventListener('click', (e) => {
                e.stopPropagation();
                e.stopImmediatePropagation();

                document.dispatchEvent(this.toggleSidebarEvent);
            });
        }

        /**
         * Listen to the toggle-sidebar event
         */
        document.addEventListener('toggle-sidebar', (e) => {
            if (!this.body.classList.contains('sidebar-expanded')) {
                // Show sidebar
                this.showSidebar();
            } else {
                // Hide sidebar
                this.hideSidebar();
            }
        });

        /**
         * Hide sidebar, if user clicks an element that is located outside.
         */
        document.addEventListener('click', (e) => {
            e.stopPropagation();

            // Get the clicked element
            const clickedEl = e.target;

            /**
             * Use this helper function, to check if an element is a child of a given parent element
             */
            const contains = (sidebar, child) => {
                return sidebar && sidebar !== child && sidebar.contains(child);
            }

            // Hide sidebar
            if (!Object.is(clickedEl, this.sidebar) && !contains(this.sidebar, clickedEl)) {
                this.hideSidebar();
            }

        });
    }

    showSidebar = function () {

        this.body.classList.add('sidebar-expanded');

        for (let i = 0; i < this.togglers.length; i++) {
            const toggler = this.togglers[i];
            toggler.setAttribute('aria-expanded', true);
            toggler.setAttribute('aria-hidden', false);
        }
    }

    hideSidebar = function () {

        this.body.classList.remove('sidebar-expanded');

        for (let i = 0; i < this.togglers.length; i++) {
            const toggler = this.togglers[i];
            toggler.setAttribute('aria-expanded', false);
            toggler.setAttribute('aria-hidden', true);
        }
    }
}




