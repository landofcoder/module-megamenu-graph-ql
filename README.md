# Mage2 Module Lof MegamenuGraphQl

    ``landofcoder/module-megamenu-graph-ql``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)
 
### Requirement
- https://landofcoder.com/magento-2-mega-menu-pro.html

## Main Functionalities
magento 2 megamenu graphql extension

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Lof`
 - Enable the module by running `php bin/magento module:enable Lof_MegamenuGraphQl`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require landofcoder/module-productlist-graph-ql`
 - enable the module by running `php bin/magento module:enable Lof_MegamenuGraphQl`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Query

1. Get menu profile with menu alias

Flagment:

```
fragment MenuNode on MegamenuItemNode {
    name
    show_name
    classes
    child_col
    sub_width
    align
    icon_position
    icon_classes
    is_group
    status
    disable_bellow
    show_icon
    icon
    show_header
    header_html
    show_left_sidebar
    left_sidebar_width
    menu_id
    left_sidebar_html
    show_content
    content_width
    content_type
    link_type
    link
    category
    target
    content_html
    show_right_sidebar
    right_sidebar_width
    right_sidebar_html
    show_footer
    footer_html
    color
    hover_color
    bg_color
    bg_hover_color
    inline_css
    tab_position
    before_html
    after_html
    caret
    hover_caret
    sub_height
    hover_icon
    dropdown_bgcolor
    dropdown_bgimage
    dropdown_bgimagerepeat
    dropdown_bgpositionx
    dropdown_bgpositiony
    dropdown_inlinecss
    parentcat
    animation_in
    animation_time
    child_col_type
    submenu_sorttype
    isgroup_level
}
```

Query (get 3 levels of menu item node) for menu profile alias ``top-menu``:

```
{
  megamenu (alias: "top-menu") {
    name
    alias
    disable_bellow
    event
    classes
    width
    disable_iblocks
    desktop_template
    scrolltofixed
    mobile_template
    nodes {
        ...MenuNode
        child_nodes {
            ...MenuNode
            child_nodes {
                ...MenuNode
            }
        }
    }
  }
}
```

2. Get list available menu profiles

Query:

```
{
    megamenus (
        filters: {}
        pageSize: 10
        currentPage: 1
    ) {
        items {
            name
            alias
        }
    }
}
```

3. Get Store Config

Query:

```
storeConfig {
    megamenu_general_enabled
    megamenu_general_menu_alias
    megamenu_general_custom_css
}
```
