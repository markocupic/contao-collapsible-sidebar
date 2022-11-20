<img src="docs/logo.png" width="200">

# Contao Collapsible Sidebar
This extension for Contao CMS provides a collapsible sidebar.

![Frontend](docs/frontend/screencast.gif)


## Installation
Via Contao Manager or composer `require markocupic/contao-collapsible-sidebar`.


## Configuration


### 1. Create the frontend module
Create a new frontend module of type **"Collapsible Sidebar"**. Do not forget to add a **CSS-ID** in the experts settings.


![Frontend](docs/backend/tl_module.png)


### 2. Add the module to the layout
Add the newly created module to your layout.


### 3. Customize the `mod_collapsible_sidebar.html.twig` template
Customize the template `mod_collapsible_sidebar.html.twig`.
E.g. use the {{insert_module}} or {{insert_article}} insert tags to add more content. 
When you're done, you should save then customized template to the `templates/` folder.


### 4. Add a toggle button to the layout
Add the "toggle sidebar" button to your layout using the provided insert tag: `{{collapsible_sidebar_toggle::##module_css_id##}}`. 
Enter the **CSS-ID** of your **Collapsible Sidebar** module after `::` => `{{collapsible_sidebar_toggle::myCollapsibleSidebar}}`.

Instead of using the `{{collapsible_sidebar_toggle::myCollapsibleSidebar}}` insert tag you can write your own "toggle sidebar" button. Dont forget to add all the mandatory attributes.

```
<!-- !!! mandatory attributes: class="collapsible-sidebar-toggle" aria-expanded="true" aria-haspopup="true" aria-controls="myCollapsibleSidebar" aria-hidden="false" -->
<div id="myCollapsibleSidebarToggle" class="collapsible-sidebar-toggle" role="button" aria-expanded="true" aria-haspopup="true" aria-controls="collapsibleSidebar" aria-hidden="false">
    <span class="icon">☰</span> Open Sidebar
</div>
```

You can even create your custom `collapsible_sidebar_toggle.html.twig` template, which is used by the Insert Tag listener.
Simply save the customized template to the templates folder: `templates/collapsible_sidebar_toggle.html.twig`.

```
{# templates/collapsible_sidebar_toggle.html.twig #}

<div id="myCollapsibleSidebarToggle" class="collapsible-sidebar-toggle" role="button" aria-expanded="true" aria-haspopup="true" aria-controls="{{ aria_controls }}" aria-hidden="false">
    <span class="icon">☰</span> Open Sidebar
</div>
```


### 5. Use your own CSS to style the application
The extension is shipped with a very minimalistic stylesheet. To override the default CSS remove `{% do addCssResource('bundles/markocupiccontaocollapsiblesidebar/css/collapsible_sidebar.css') %}` in the head of your customized module template `/templates/mod_collapsible_sidebar.html.twig` and use your own stylesheet.


### 6. Clear and renew the cache
Use `composer install` or the Contao Manager to rebuild the cache.
