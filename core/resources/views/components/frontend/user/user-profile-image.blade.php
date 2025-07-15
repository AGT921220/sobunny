@if(auth()->guard('web')->user())
    <button class="seller-img p-0">
        @if(!empty(Auth::guard('web')->user()->image))
            {!! render_image_markup_by_attachment_id(Auth::guard('web')->user()->image) !!}
        @else
            <img src="{{ asset('assets/frontend/img/static/user-no-image.webp') }}" alt="No Image">
        @endif
  </button>
@else
    {{-- <div class="btn-wrapper">
        <a href="{{ route('user.login') }}"  class="cmn-btn sign-in">
            {{ __('Sign In') }}
        </a>
    </div> --}}
    <li class="single">
        <div class="btn-wrapper">
            <a href="{{ route('user.login') }}" class="cmn-btn1 popup-modal">
                <i class="las la-user-circle"></i><span class="text">{{ __('Sign In') }}</span>
            </a>
        </div>
    </li>
@endif


