## About Sports Report

This was originally designed as a way to archive sports highlights for [Highlights Arena](https://highlightsarena.com/). A sports opinion and media archiving website. Our interest in doing such a thing wained over time but some of the underlying functionality of this might be helpful to others.

Primarily the interpreter controller. It acts as a base class to parse content embeding APIs for a lot of the webs leading content hosting services. Currently it gets the formed `<iframe>` for embeding a post. It stores the iframe with other data to the database and the interates it back out based on time posted.

You can do whatever you please with the interpreter output though if you want to just steal that class from this project or use this project as a way to archive specific post across a wide array of websites.

## Other Notes

In your .env file you'll need to set the following variables:
- POST_PER_PAGE = `int` | Tells the app how many post you want displayed per page.
- APP_USERAGENT = `String` | The sports standings in the sidebar are in part pulled from [erikberg.com](https://erikberg.com/api) who is kind enough to provide free standings data in xml or json format. To stop too many spam request each app must indentify itself with a unique useragent.

## I don't want sports standings in my sidebar or want to modify them. How do I do that?
No problem. This app was originally written with sports and popular entertainment in mind. There is a service provider called leagueStandingsProvider.php which uses the leagueStandings controller class. All the API access is handled in there including caching. You can modify the leagueStandings controller to return different standings at different times of the year or write your own functions to fetch different data the suits your needs.

All of this data is output to the standings.blade.php file which can be modified as you see fit to add whatever you'd like to your sidebar.

One missnomer is that the leagueStandingsProvider passes everything to standings.blade through the nhlStandings() function. This was because at the time only hockey was in season so the name was shortsided. At some point the function needs to be updated to have a more neutral name describing what it does.

## How do I change the images in the header?

The header was done for fun to load a different image from a collection each time at the top of the page. I took the time to style them all the same and you can do the same if you like. Inside of the `public/images/header-images/` folder you'll find a number of images. They are all royalty free if you're cloning in this repository so don't worry about using them. I got them all from [Pixabay](https://pixabay.com/en/) or took them myself.

Simply delete and swap out any images you want. Adding new images to the folder will result in them automatically being detected by the app. Please note that the images must be PNGs.

The underlying code for how this selection is done can be found in the navigationServiceProvider class.

## What are the tags at the top of the site?

You can take post to allow them to be searched and grouped as one/or keep like post with like post. However you want to think of your tagging structure. 5 random tags are displayed at the top of the site. This was done to promote clicking around by users to allow for more diverse content exploring. You can also modify or remove this behavior by looking in the navigationServiceProvider class or removing the `Show popular/used tags in the header` section of code from the app.blade.php file.

## License
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/">Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License</a>.

For commercial use please contact me at jackemceachern[at]gmail.com

## Warranty
This app is provided as is with no guarantee of any future support. Use it at your own risk. I am not responsible for any loss or damages you incure by using this app.

If you need help or want to contribute please contact me. I cannot guarantee I'll get back to you but I will try my best.
