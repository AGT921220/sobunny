@extends('frontend.layout.master')
@section('site_title',__('Live Chat'))
@section('content')
    <!-- Messages Area s t a r t-->
    <div class="messagesArea section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="messagesWrapper">
                        <div class="row">
                            @if($member_chat_list->count() > 0)
                                <!-- all member listing  area-->
                                <div class="col-xl-5 col-lg-6 col-md-12">
                                    <div class="userList">
                                        <!-- Single member list -->
                                        @foreach($member_chat_list as $member_chat)
                                            <x-chat::member.user-list :memberChat="$member_chat" />
                                        @endforeach
                                    </div>
                                </div>
                                <!--all message listing area -->
                                <div class="col-xl-7 col-lg-6 col-md-12">
                                    <div class="messagesDetails">
                                        <!-- Header top for chat user info -->
                                        <div class="showProduct mb-5">
                                            <div class="chat-wrapper-details-header d-none flex-between" id="chat_header">
                                            </div>
                                        </div>
                                        <!-- End Header top for chat user info -->

                                        <!-- MessageBox -->
                                        <div class="messageBox">
                                            <!--main message area start -->
                                            <div class="messageShow">
                                                <!--new design -->
                                                <div class="chat-wrapper-details-inner user-chat-body" id="chat_body">
                                                </div>
                                            </div>
                                            <!-- messageSend input box-->
                                            <div class="messageSend d-none" id="member-message-footer">
                                                <!--message box -->
                                                <form action="#" method="get">
                                                    <textarea class="input  form-message" name="message" id="message" placeholder="{{ __('Write your message') }}"></textarea>
                                                </form>

                                                <!--Submit Button -->
                                                <div class="btn-wrapper form-icon">
                                                    <!--file section -->
                                                    <div class="imgSlector" id="uploadImage">
                                                        <input class="photo-uploaded-file inputTag" id="message-file" type="file">
                                                        <span class="show_uploaded_file"></span>
                                                        <label class="live_chat_attach_btn" for="message-file">
                                                            <i class="fa-solid fa-paperclip fs-5"></i> <span class="attach_files_title">{{ __("Attach Files") }}</span>
                                                        </label>
                                                    </div>
                                                    <a href="javascript:void(0)" class="btn-rounded2" id="member-send-message-to-user"> {{ __('Send Message') }}</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-12 mt-5 mb-5">
                                    <div class="chat-wrapper">
                                        <div class="chat-wrapper-flex">
                                            <div class="chat-sidebar d-lg-none">
                                                <i class="fas fa-bars"></i>
                                            </div>
                                            <div class="chat-wrapper-contact">
                                                <div class="chat-wrapper-contact-close">
                                                    <div class="close-chat d-lg-none"> <i class="fas fa-times"></i> </div>
                                                    <ul class="chat-wrapper-contact-list">
                                                        <h4 class="text-danger text-center mt-5">{{ __('No Contacts Yet.') }}</h4>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="chat-wrapper-details"> </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                 </div>
             </div>
        </div>
    </div>
<!-- End-of Messages Area -->
<audio id="chat-alert-sound" style="display: none">
    <source src="{{ asset('assets/uploads/chat_image/sound/facebook_chat.mp3') }}" />
</audio>
@endsection
@section('scripts')
    <script src="{{ asset('assets/common/js/helpers.js') }}"></script>
    <script>
        let user_list = { {{ $arr }} };
    </script>
    <x-chat::livechat-js />
    <x-chat::member.member-chat-js />
    <script>
        $(document).on('click','.get_user_id',function(){
            $('#user_id').val($(this).data('user-id'));
        });
    </script>
    <script>
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                  toastr.warning("{{ $error }}");
            @endforeach
        @endif
    </script>
@endsection
