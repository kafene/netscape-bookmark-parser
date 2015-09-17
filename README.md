# About

Basically netscape bookmark files often come so badly formed, there's
no reliable way I could find to parse them with DOM or SimpleXML,
even after running HTML Tidy on them. So, this function does a bunch of
transformations on the general format of a netscape bookmark file, to get
Each bookmark and its description onto one line, and goes through line by
line, matching tags and attributes. It's messy, but it works better than
anything I could find in hours of googling, and anything that I could
write after hours with DOM and SimpleXML. I didn't want to pull in a big
DOM parsing library just to do this one thing, so this is it.

# Changes

**2015-09-17**:

- Added a LICENSE file
- Added a `composer.json` file and added to packagist
- Tag release v0.0.2

**2013-07-08**:

Just tested this on an export of some bookmarks from Pinboard.in
and it seems that it is still working, so good for me.

# Todo

- [ ] Running Tidy before doing this might be beneficial: `$bkmk_str = tidy_parse_string($bkmk_str)->cleanRepair();`

# Example

```php
var_dump(parse_netscape_bookmarks(file_get_contents('bookmarks_export.htm')));
```
