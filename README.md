# WP Test Repository

Just another WordPress test task.

## Contents

This repo includes the following directories & files:

* `dev`. Contains scss files and gulp file.
* `test`. Parent theme with all necessary files.
* `test-child`. Child theme with all the files.
* `test-plugin` Plugin which shows `Hello World` message.
* `wptest.sql` DB dump.

### dev

Use `npm install` to install all the dependencies. And different commands to compile scss files.

* `npm run styles`. Single compilation + source maps.
* `npm run styles:watch`. Watcher & compilation + source maps.
* `npm run styles:prod`. Single compressed compilation.
* `npm run styles:prod:watch`. Watcher & compressed compilation.

### test

Parent theme. Logo needs to be uploaded as custom logo via customizer. It has woocommerce customized `/shop` page, regular pages and front-page.

### test-child

Child theme. It has a `[wptest_hello]` shortcode, which displays:

```
<div class="test-shortcode">Hello World!</div>
```

### test-plugin

An OOP plugin which show yet another "Hello World" message before news on the front page. Colors differes from green from 8 am to 6 pm to purple from 6 pm to 8 am.

### wptest.sql

An SQL dump with the database.