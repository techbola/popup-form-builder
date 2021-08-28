<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>

<div id="poptin-popup-dialog" class="popup" onclick="closeModal()">
    <div class="popup_container d-flex justify-content-center align-items-center">
        <div class="popup_block" style="background: {{ $bgColor  }}">
            @foreach($formBuilderOrder as $item)
                @if($item === 'star')
                    <div class="star-popup-field" style="position: absolute;top: {{ $starYPos.'px' }};left: {{ $starXPos.'px' }};">
                        <i class="fas fa-star mr-2"></i>
                        <i class="fas fa-star mr-2 big-star"></i>
                        <i class="fas fa-star mr-2"></i>
                    </div>
                @elseif($item === 'text')
                    <div class="text-popup-field" style="color: {{ $textColor }};position: absolute;top: {{ $textYPos.'px !important' }};left: {{ $textXPos.'px !important' }};">{!! $textValue !!}</div>
                @elseif($item === 'input')
                    <input type="text" class="form-control input-popup-field" :placeholder="{{ $inputPlaceholder }}" style="position: absolute;top: {{ $inputYPos.'px' }};left: {{ $inputXPos.'px' }};">
                @elseif($item === 'button')
                    <button class="btn btn-dark btn-lg btn-block text-uppercase button-popup-field" style="position: absolute;top: {{ $buttonYPos.'px' }};left: {{ $buttonXPos.'px' }};">{{ $buttonText }}</button>
                @endif
            @endforeach

                <p class="info">
                    No credit card is required. No Surprises
                </p>
        </div>
    </div>
</div>

</body>
</html>