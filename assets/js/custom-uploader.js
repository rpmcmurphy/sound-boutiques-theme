// For slider image metabox on product page
jQuery(document).ready(function() {
    jQuery('body').on('click', '#soundboutiques_add_slider_image_button', function(e){
        e.preventDefault();

        var button = jQuery(this),
            slider_img_tag = jQuery('.slider-image-tag'),
            remove_slider_image = jQuery('.remove-slider-image'),
            hidden_upload_input = jQuery('.hidden_upload_input'),
            soundboutiques_custom_uploader;

        soundboutiques_custom_uploader = wp.media({
            frame: 'select',
            title: 'Add slider image for this track',
            library : {
                uploadedTo : wp.media.view.settings.post.id,
                type : 'image'
            },
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        soundboutiques_custom_uploader.on('select', function() {
            var attachment = soundboutiques_custom_uploader.state().get('selection').first().toJSON();
            jQuery(hidden_upload_input).val(attachment.url);
            slider_img_tag.attr('src', attachment.url).show();
            remove_slider_image.show();
        })

        soundboutiques_custom_uploader.open();
    });

	jQuery('body').on('click', '.remove-slider-image', function(e){
		e.preventDefault();

        var button = jQuery(this),
            slider_img_tag = jQuery('.slider-image-tag'),
            hidden_upload_input = jQuery('.hidden_upload_input');
        button.hide();
        jQuery(hidden_upload_input).val('');
		slider_img_tag.attr('src', '#').hide();
	});
});

// For track metabox on product page
jQuery(document).ready(function() {
    jQuery('body').on('click', '#wp_custom_attachment_button', function(e){
        e.preventDefault();

        var button = jQuery(this),
            track_link_tag = jQuery('.track-link-tag'),
            remove_track_file = jQuery('.remove-player-track'),
            hidden_track_upload_input = jQuery('.hidden_track_upload_input'),
            soundboutiques_custom_track_uploader;

        soundboutiques_custom_track_uploader = wp.media({
            frame: 'select',
            title: 'Upload track player file',
            library : {
                uploadedTo : wp.media.view.settings.post.id,
                type : 'audio'
            },
            button: {
                text: 'Use this track'
            },
            multiple: false
        });

        soundboutiques_custom_track_uploader.on('select', function() {
            var attachment = soundboutiques_custom_track_uploader.state().get('selection').first().toJSON();
            jQuery(hidden_track_upload_input).val(attachment.url);
            track_link_tag.attr('href', attachment.url).show();
            remove_track_file.show();
        })

        soundboutiques_custom_track_uploader.open();
    });

	jQuery('body').on('click', '.remove-player-track', function(e){
		e.preventDefault();

        var button = jQuery(this),
            track_link_tag = jQuery('.track-link-tag'),
            hidden_track_upload_input = jQuery('.hidden_track_upload_input');
        button.hide();
        jQuery(hidden_track_upload_input).val('');
		track_link_tag.attr('href', '#').hide();
	});
});

// For waveform metabox on product page
jQuery(document).ready(function() {
    jQuery('body').on('click', '#soundboutiques_add_waveform_image_button', function(e){
        e.preventDefault();

        var button = jQuery(this),
            waveform_img_tag = jQuery('.waveform-image-tag'),
            remove_waveform_image = jQuery('.remove-waveform-image'),
            hidden_waveform_upload_input = jQuery('.hidden_waveform_upload_input'),
            soundboutiques_custom_waveform_uploader;

        soundboutiques_custom_waveform_uploader = wp.media({
            frame: 'select',
            title: 'Add waveform image for this track',
            library : {
                uploadedTo : wp.media.view.settings.post.id,
                type : 'image'
            },
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        soundboutiques_custom_waveform_uploader.on('select', function() {
            var attachment = soundboutiques_custom_waveform_uploader.state().get('selection').first().toJSON();
            jQuery(hidden_waveform_upload_input).val(attachment.url);
            waveform_img_tag.attr('src', attachment.url).show();
            remove_waveform_image.show();
        })

        soundboutiques_custom_waveform_uploader.open();
    });

	jQuery('body').on('click', '.remove-waveform-image', function(e){
		e.preventDefault();

        var button = jQuery(this),
            waveform_img_tag = jQuery('.waveform-image-tag'),
            hidden_waveform_upload_input = jQuery('.hidden_waveform_upload_input');
        button.hide();
        jQuery(hidden_waveform_upload_input).val('');
		waveform_img_tag.attr('src', '#').hide();
	});
});
