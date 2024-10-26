<?php

namespace plugins\WidgetsBuilder\Widgets;

use plugins\PageBuilder\Helpers\RepeaterField;
use plugins\PageBuilder\Traits\LanguageFallbackForPageBuilder;
use plugins\WidgetsBuilder\WidgetBase;
use plugins\PageBuilder\Fields\Repeater;

class PrivacyPolicy extends WidgetBase
{
    use LanguageFallbackForPageBuilder;

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        //repeater
        $output .= Repeater::get([
            'settings' => $widget_saved_values,
            'id' => 'contact_page_contact_info_01',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('Url')
                ],
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();

        $repeater_data = $settings['contact_page_contact_info_01'];
        $privacy_policy_markup = '';

        foreach ($repeater_data['title_'] as $key => $title) {
            $title = purify_html($title);
            $url = $repeater_data['url_'][$key];
            $privacy_policy_markup.= <<<PRIVACYPOLICY
            <li class="listItem wow fadeInUp" data-wow-delay="0.0s">  <a class="singleLinks" href="{$url}">{$title}</a></li>

PRIVACYPOLICY;
    }

   return <<<HTML
    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
         <div class="footer-widget widget  mb-24">
             <div class="footer-tittle">
                <ul class="listing">
                   {$privacy_policy_markup}
                </ul>
            </div>
        </div>
    </div>
HTML;
    }

    public function widget_title()
    {
        return __('Privacy Policy');
    }

}
