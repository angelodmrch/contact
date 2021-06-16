# Contact Plugin

Plugin to manage Contacts Forms.

## Implementing front-end pages

Use the `forms` component to display a Contact Form. The component has the following properties:

* **code** - code of the form.

The example shows the basic component usage of Contact Forms:

    title = "Home"
    url = "/"
    id = "home"

    [forms]

    ==

    ...

    {% component 'forms' code='contact' %}

    ...


The example shows the basic component usage of Newsletter:

    title = "Home"
    url = "/"
    id = "home"

    [newsletter]

    ==

    ...

    {% component 'newsletter' %}

    ...