# colby-wp-collapsible

A WordPress shortcode for collapsible HTML drawers.

[Example](https://colbycommunications.github.io/wp-collapsible/example/)

## Install

### Via Composer

```
composer require colbycomms/wp-collapsible
```

### As a WordPress plugin

Clone this directory into wp-content/plugins and activate it through WordPress.

## Usage

Use the following shortcode:

```HTML
[collapsible title="Title" open="true"]
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi a pellentesque lectus. Duis semper ex vitae dolor mattis, at dictum ligula mollis. Vestibulum feugiat, augue ut tincidunt semper, tellus quam elementum mauris, id hendrerit sapien lorem eu est. Fusce consectetur et risus vitae fringilla. Fusce rhoncus varius mauris vel cursus. Nullam tempor lacus eu ante laoreet vehicula. In ultricies nibh fringilla feugiat malesuada. Aenean sed malesuada justo. Ut at pretium velit. Suspendisse lacinia euismod facilisis. Nam sed nulla quis sem viverra gravida. Donec ut luctus odio.

	Cras tincidunt ex nec efficitur tempus. Phasellus lobortis quis sapien nec finibus. Vivamus quis justo id diam porta pulvinar at et turpis. Vivamus ac nunc odio. Vivamus pellentesque semper mi, sed cursus est vehicula eget. Integer dignissim orci sed sodales ornare. Mauris viverra felis sed pellentesque efficitur. Vivamus semper quam nec cursus condimentum. Quisque finibus dui et risus cursus fermentum. Fusce malesuada pretium sapien in euismod. Sed rutrum, nunc in dictum varius, ipsum nunc placerat nibh, nec commodo neque nisl sed elit. Etiam vel ex pulvinar, luctus urna maximus, tempor massa. Vestibulum vel enim aliquet leo vestibulum luctus. Suspendisse pharetra magna iaculis faucibus finibus. Proin laoreet facilisis sapien in laoreet.
[/collapsible]
```

The shortcode will output nothing if there is no closing tag or no content
between the opening and closing tags.

#### Shortcode attributes

| Attribute     | Description                                                | Required | Default |
| ------------- | ---------------------------------------------------------- | -------- | ------- |
| title/trigger | The text to display in the drawer opener                   | required |         |
| open          | Open the drawer on pageload? Enter "1" or "true" for true. | optional | "false" |
