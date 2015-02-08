# Easy Code Snippets Library
##### Developed and maintained by Izaac Johansson

Easy Code Snippets Library (here on called ECSL) is developed to create a gist-like library on a WordPress site. It contains a custom post type and it's own archive and single templates. It do also include two distinct shortcodes, explained below.

#### Shortcodes
##### Show a single snippet anywhere on the site, with prettify highlightning:
````
[ecsl-snippet id={id} only_code={true/false}]
````
###### Parameter(s):
int _id_ : The specific ID of the code snippet to show.
bool _only_code_ : Default: true. If set to true it will only show highlighted code, no extras like title, date, tags, language.

##### Show a list of snippets anywhere on the site.
````
[ecsl-snippets]
````
###### Parameter(s):
null _none_ : No parameters at this time
