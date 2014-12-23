//////////////////////////////////////////////////////////////////
// Add Youtube button
//////////////////////////////////////////////////////////////////
/*
(function() {  
    tinymce.create('tinymce.plugins.youtube', {  
        init : function(ed, url) {  
            ed.addButton('youtube', {  
                title : 'Add a Youtube video',  
                image : url+'/button-youtube.png',  
                onclick : function() {  
                     ed.selection.setContent('[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('youtube', tinymce.plugins.youtube);  
})();

//////////////////////////////////////////////////////////////////
// Add Vimeo button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.vimeo', {  
        init : function(ed, url) {  
            ed.addButton('vimeo', {  
                title : 'Add a Vimeo video',  
                image : url+'/button-vimeo.png',  
                onclick : function() {  
                     ed.selection.setContent('[vimeo id="Enter video ID (eg. 10145153)" width="600" height="350"]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('vimeo', tinymce.plugins.vimeo);  
})();

//////////////////////////////////////////////////////////////////
//Add SoundCloud button
//////////////////////////////////////////////////////////////////
(function() {  
 tinymce.create('tinymce.plugins.soundcloud', {  
     init : function(ed, url) {  
         ed.addButton('soundcloud', {  
             title : 'Add a SoundCloud widget',  
             image : url+'/soundcloud.png',  
             onclick : function() {  
                  ed.selection.setContent('[soundcloud url="http://api.soundcloud.com/tracks/26719991" width="100%" height="166" params="auto_play=false&show_artwork=false&color=8bc84f" iframe="true" /]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('soundcloud', tinymce.plugins.soundcloud);  
})();
//////////////////////////////////////////////////////////////////
//Quote Box
//////////////////////////////////////////////////////////////////
(function() {  
 tinymce.create('tinymce.plugins.qbox', {  
     init : function(ed, url) {  
         ed.addButton('qbox', {  
             title : 'Add a Quatation Box',  
             image : url+'/quote-box.png',  
             onclick : function() {  
                  ed.selection.setContent('[qbox title1="Why Choose Creativo" title2="Creating a website has never been easier" icon="http://rockythemes.com/creativo/wp-content/uploads/2013/01/settings.png"]Quisque justo lorem, condimentum condimentum ornare vel, consectetur id justo? Phasellus leo lacus, rhoncus dictum auctor. [/qbox]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('qbox', tinymce.plugins.qbox);  
})();
*/
//////////////////////////////////////////////////////////////////
// Add Button button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.button', {  
        init : function(ed, url) {  
            ed.addButton('button', {  
                title : 'Add a button',  
                image : url+'/button-button.png',  
                onclick : function() {  
                     ed.selection.setContent('[button style="e.g. green, yellow, purple, blue, red, black, grey" float="right or left" margin="e.g. 10, 15, 20" size="large or small" link="" target=""]Your Text[/button]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('button', tinymce.plugins.button);  
})();

//////////////////////////////////////////////////////////////////
// Add Divider button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.divider', {  
        init : function(ed, url) {  
            ed.addButton('divider', {  
                title : 'Add a divider',  
                image : url+'/divider-button.png',  
                onclick : function() {  
                     ed.selection.setContent('[divider style="e.g. blank, dotted, solid, double"][/divider]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('divider', tinymce.plugins.divider);  
})();

//////////////////////////////////////////////////////////////////
// Add Dropcap button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.dropcap', {  
        init : function(ed, url) {  
            ed.addButton('dropcap', {  
                title : 'Add a dropcap',  
                image : url+'/button-dropcap.png',  
                onclick : function() {  
                     ed.selection.setContent('[dropcap color="e.g. green, yellow, purple, blue, red, black, grey" background="e.g. green, yellow, purple, blue, red, grey, black" style="rectangle, rounded, circle" size="e.g. small, big"]...[/dropcap]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('dropcap', tinymce.plugins.dropcap);  
})();

//////////////////////////////////////////////////////////////////
// Add Highlight button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.highlight', {  
        init : function(ed, url) {  
            ed.addButton('highlight', {  
                title : 'Add a highlight',  
                image : url+'/button-highlight.png',  
                onclick : function() {  
                     ed.selection.setContent('[highlight style="eg. green, yellow, purple, blue, red, black, grey"]...[/highlight]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);  
})();

//////////////////////////////////////////////////////////////////
// Add Checklist button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.checklist', {  
        init : function(ed, url) {  
            ed.addButton('checklist', {  
                title : 'Add a checklist',  
                image : url+'/button-checklist.png',  
                onclick : function() {  
                     ed.selection.setContent('[checklist style="eg. green, yellow, purple, blue, red, black, grey"]<ul>\r<li>My First Item</li>\r<li>My Second Item</li>\r<li>My Third Item</li>\r</ul>[/checklist]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('checklist', tinymce.plugins.checklist);  
})();

//////////////////////////////////////////////////////////////////
// Add Badlist button
//////////////////////////////////////////////////////////////////
/*
(function() {  
    tinymce.create('tinymce.plugins.badlist', {  
        init : function(ed, url) {  
            ed.addButton('badlist', {  
                title : 'Add a badlist',  
                image : url+'/button-badlist.png',  
                onclick : function() {  
                     ed.selection.setContent('[badlist]<ul>\r<li>Item #1</li>\r<li>Item #2</li>\r<li>Item #3</li>\r</ul>[/badlist]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('badlist', tinymce.plugins.badlist);  
})();
	
//////////////////////////////////////////////////////////////////
// Add Tabs button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.tabs', {  
        init : function(ed, url) {  
            ed.addButton('tabs', {  
                title : 'Add tabs',  
                image : url+'/button-tabs.png',  
                onclick : function() {  
                     ed.selection.setContent('[tabs tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\" color="grey, green, blue, yellow, red, black, purple"]<br /><br />[tab id=1]Tab content 1[/tab]<br />[tab id=2]Tab content 2[/tab]<br />[tab id=3]Tab content 3[/tab]<br /><br />[/tabs]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('tabs', tinymce.plugins.tabs);  
})();

//////////////////////////////////////////////////////////////////
// Add Toggle button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.toggle', {  
        init : function(ed, url) {  
            ed.addButton('toggle', {  
                title : 'Add a toggle',  
                image : url+'/button-toggle.png',  
                onclick : function() {  
                     ed.selection.setContent('[toggle title="My Toggle Title" style="eg. green, yellow, purple, blue, red, black, grey" open="no"]This is where the content of the toggle comes[/toggle]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('toggle', tinymce.plugins.toggle);  
})();

//////////////////////////////////////////////////////////////////
// Add Shortcode Wrapper
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.outter_wrapper', {  
        init : function(ed, url) {  
            ed.addButton('outter_wrapper', {  
                title : 'Add a Shortcode Wrapper',  
                image : url+'/wrapper.png',  
                onclick : function() {  
                     ed.selection.setContent('[outter_wrapper title="Enter a title for the wrapper" background="lightgrey, white"]<p>...</p>[/outter_wrapper]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('outter_wrapper', tinymce.plugins.outter_wrapper);  
})();


//////////////////////////////////////////////////////////////////
// Add One_half button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.one_half', {  
        init : function(ed, url) {  
            ed.addButton('one_half', {  
                title : 'Add a one_half column',  
                image : url+'/button-12.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_half last="no"]...[/one_half]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_half', tinymce.plugins.one_half);  
})();

//////////////////////////////////////////////////////////////////
// Add One_third button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.one_third', {  
        init : function(ed, url) {  
            ed.addButton('one_third', {  
                title : 'Add a one_third column',  
                image : url+'/button-13.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_third last="no"]...[/one_third]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_third', tinymce.plugins.one_third);  
})();




//////////////////////////////////////////////////////////////////
// Add Two_half button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.two_third', {  
        init : function(ed, url) {  
            ed.addButton('two_third', {  
                title : 'Add a two_third column',  
                image : url+'/button-23.png',  
                onclick : function() {  
                     ed.selection.setContent('[two_third last="no"]...[/two_third]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('two_third', tinymce.plugins.two_third);  
})();

//////////////////////////////////////////////////////////////////
// Add one_fourth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.one_fourth', {  
        init : function(ed, url) {  
            ed.addButton('one_fourth', {  
                title : 'Add a one_fourth column',  
                image : url+'/button-14.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_fourth last="no"]...[/one_fourth]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_fourth', tinymce.plugins.one_fourth);  
})();

//////////////////////////////////////////////////////////////////
// Add three_fourth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.three_fourth', {  
        init : function(ed, url) {  
            ed.addButton('three_fourth', {  
                title : 'Add a three_fourth column',  
                image : url+'/button-34.png',  
                onclick : function() {  
                     ed.selection.setContent('[three_fourth last="no"]...[/three_fourth]');   
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('three_fourth', tinymce.plugins.three_fourth);  
})();

//////////////////////////////////////////////////////////////////
// Add one_fifth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.one_fifth', {  
        init : function(ed, url) {  
            ed.addButton('one_fifth', {  
                title : 'Add a 1/5 column',  
                image : url+'/button-15.png',  
                onclick : function() {  
                     ed.selection.setContent('[one_fifth last="no"]...[/one_fifth]');   
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('one_fifth', tinymce.plugins.one_fifth);  
})();

//////////////////////////////////////////////////////////////////
// Add two_fifth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.two_fifth', {  
        init : function(ed, url) {  
            ed.addButton('two_fifth', {  
                title : 'Add a 2/5 column',  
                image : url+'/button-25.png',  
                onclick : function() {  
                     ed.selection.setContent('[two_fifth last="no"]...[/two_fifth]');   
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('two_fifth', tinymce.plugins.two_fifth);  
})();

//////////////////////////////////////////////////////////////////
// Add three_fifth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.three_fifth', {  
        init : function(ed, url) {  
            ed.addButton('three_fifth', {  
                title : 'Add a 3/5 column',  
                image : url+'/button-35.png',  
                onclick : function() {  
                     ed.selection.setContent('[three_fifth last="no"]...[/three_fifth]');   
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('three_fifth', tinymce.plugins.three_fifth);  
})();

//////////////////////////////////////////////////////////////////
// Add four_fifth button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.four_fifth', {  
        init : function(ed, url) {  
            ed.addButton('four_fifth', {  
                title : 'Add a 4/5 column',  
                image : url+'/button-45.png',  
                onclick : function() {  
                     ed.selection.setContent('[four_fifth last="no"]...[/four_fifth]');   
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('four_fifth', tinymce.plugins.four_fifth);  
})();

//////////////////////////////////////////////////////////////////
// Add slider button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.slider', {  
        init : function(ed, url) {  
            ed.addButton('slider', {  
                title : 'Add a slider',  
                image : url+'/slider-icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[slider]<br />[slide link=""]image link[/slide]<br />[slide link=""]image link[/slide]<br />[/slider]');
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('slider', tinymce.plugins.slider);  
})();
*/
//////////////////////////////////////////////////////////////////
// Add testimonial button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.testimonial', {  
        init : function(ed, url) {  
            ed.addButton('testimonial', {  
                title : 'Add a testimonial',  
                image : url+'/testimonial-icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[testimonial name="Easy JacK" style="eg. green, yellow, purple, blue, red, black, grey" company="My Company"]"Donec eget dignissim augue. Donec ante felis, aliquam ut consequat eget, lobortis dapibus risus. Aliquam laoreet enim et lectus ornare hendrerit. Aliquam rhoncus enim libero. Morbi aliquam, nibh mattis feugiat dapibus, nisi massa adipiscing justo, sit amet condimentum urna ipsum et lacus. "[/testimonial]');
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('testimonial', tinymce.plugins.testimonial);  
})();

//////////////////////////////////////////////////////////////////
// Add Custom BlockQuote button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.custom_blockquote', {  
        init : function(ed, url) {  
            ed.addButton('custom_blockquote', {  
                title : 'Add a Custom Blockquote',  
                image : url+'/blockquote.png',  
                onclick : function() {  
                     ed.selection.setContent('[custom_blockquote style="eg. green, yellow, purple, blue, red, black, grey"] Donec eget dignissim augue. Donec ante felis, aliquam ut consequat eget, lobortis dapibus risus. Aliquam laoreet enim et lectus ornare hendrerit. Aliquam rhoncus enim libero. Morbi aliquam, nibh mattis feugiat dapibus, nisi massa adipiscing justo, sit amet condimentum urna ipsum et lacus. [/custom_blockquote]');
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('custom_blockquote', tinymce.plugins.custom_blockquote);  
})();
/*
//////////////////////////////////////////////////////////////////
// Add Progress Bar Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.progress', {  
        init : function(ed, url) {  
            ed.addButton('progress', {  
                title : 'Add a progress bar',  
                image : url+'/button-progress.png',  
                onclick : function() {  
                     ed.selection.setContent('[bar percentage="60" style="eg. green, yellow, purple, blue, red, black, grey"]Web Design[/bar]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('progress', tinymce.plugins.progress);  
})();

//////////////////////////////////////////////////////////////////
// Add Post Gallery Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.postgallery', {  
        init : function(ed, url) {  
            ed.addButton('postgallery', {  
                title : 'Add a Post Gallery',  
                image : url+'/gallery.png',  
                onclick : function() {  
                     ed.selection.setContent('[postgallery columns="3"][/postgallery]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('postgallery', tinymce.plugins.postgallery);  
})();

//////////////////////////////////////////////////////////////////
// Add Person Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.person', {  
        init : function(ed, url) {  
            ed.addButton('person', {  
                title : 'Add a person',  
                image : url+'/person-button.png',  
                onclick : function() {  
                     ed.selection.setContent('[person name="John Doe" picture="" title="Developer" facebook="http://facebook.com" twitter="http://twitter.com" linkedin="http://linkedin.com" dribbble="http://dribbble.com"]Redantium, totam rem aperiam, eaque ipsa qu ab illo inventore veritatis et quasi architectos beatae vitae dicta sunt explicabo. Nemo enim.[/person]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('person', tinymce.plugins.person);  
})();

//////////////////////////////////////////////////////////////////
// Add Alert Messages Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.alert', {  
        init : function(ed, url) {  
            ed.addButton('alert', {  
                title : 'Add an alert message',  
                image : url+'/alert-icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[alert type="e.g. general, error, success, notice"]Your Message Goes Here.[/alert]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('alert', tinymce.plugins.alert);  
})();

//////////////////////////////////////////////////////////////////
// Add Pricing Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.pricing_table', {  
        init : function(ed, url) {  
            ed.addButton('pricing_table', {  
                title : 'Add pricing table',  
                image : url+'/pricing-icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[pricing_table type="e.g. 1 or 2"][pricing_column title="Standard"][pricing_price]$10[/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column][/pricing_table]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('pricing_table', tinymce.plugins.pricing_table);  
})();

//////////////////////////////////////////////////////////////////
// Add Recent Works Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.recent_works', {  
        init : function(ed, url) {  
            ed.addButton('recent_works', {  
                title : 'Add recent works',  
                image : url+'/folio.png',  
                onclick : function() {  
                     ed.selection.setContent('[recent_works show_filters="yes" items="8" columns="4"][/recent_works]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('recent_works', tinymce.plugins.recent_works);  
})();

//////////////////////////////////////////////////////////////////
// Add Tagline Box Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.tagline_box', {  
        init : function(ed, url) {  
            ed.addButton('tagline_box', {  
                title : 'Add tagline box',  
                image : url+'/tagline-box.png',  
                onclick : function() {  
                     ed.selection.setContent('[tagline_box link="http://themeforest.net/user/RockyThemes" style="eg. green, yellow, purple, blue, red, black, grey" button="Buy This Theme" title="Creativo is a rocksolid multipurpose theme, with 7 ready to use colors system!" description="Plus we have integrated 2 premium sliders, infinite colors and a very friendly to use theme options to easily customize your theme!"][/tagline_box]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('tagline_box', tinymce.plugins.tagline_box);  
})();

//////////////////////////////////////////////////////////////////
// Add Content Boxes Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.content_boxes', {  
        init : function(ed, url) {  
            ed.addButton('content_boxes', {  
                title : 'Add content boxes',  
                image : url+'/content-boxes.png',  
                onclick : function() {  
                     ed.selection.setContent('[content_boxes]<br />[content_box title="Design" image="http://rockythemes.com/creativo/wp-content/uploads/2013/01/mobile.png" link="http://themeforest.net/user/RockyThemes"  id="first"]Creativo is 100% responsive ready. Try resizing this window and you will see all the elements of Creativo adapting accordingly![/content_box]<br />[content_box title="Sliders" image="http://rockythemes.com/creativo/wp-content/uploads/2013/01/images.png" link="http://themeforest.net/user/RockyThemes" id="second"]Creativo comes with two premium sliders: RevolutionSlider and LayerSlider. Creating an awesome slider has never been easier.[/content_box]<br />[content_box title="Colors"  image="http://rockythemes.com/creativo/wp-content/uploads/2013/01/equalizer.png" link="http://themeforest.net/user/RockyThemes"  id="third"]Use the color options from the backend to create an infinite number of styles. It\'s really easy to create your own styles![/content_box]<br />[content_box last="yes" title="Fonts"  image="http://rockythemes.com/creativo/wp-content/uploads/2013/01/pencil.png" link="http://themeforest.net/user/RockyThemes" id="last"]Everybody loves fonts so Creativo comes with over 500+ Google Fonts. Just select the one you like from the backend![/content_box]<br />[/content_boxes]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('content_boxes', tinymce.plugins.content_boxes);  
})();

//////////////////////////////////////////////////////////////////
// Add Recent Posts Button
//////////////////////////////////////////////////////////////////
(function() {  
    tinymce.create('tinymce.plugins.recent_posts', {  
        init : function(ed, url) {  
            ed.addButton('recent_posts', {  
                title : 'Add recent posts',  
                image : url+'/recent-posts.png',  
                onclick : function() {  
                     ed.selection.setContent('[recent_posts thumbnail="yes" show_date="yes" show_excerpt="yes" posts="4" category_id=""][/recent_posts]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('recent_posts', tinymce.plugins.recent_posts);  
})();

*/