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
            <div class="popup_form mx-auto d-flex flex-column justify-content-center align-items-center">
                @foreach($formBuilderOrder as $item)
                    @if($item === 'star')
                        <div class="text-center mb-3">
                            <i class="fas fa-star mr-2"></i>
                            <i class="fas fa-star mr-2 big-star"></i>
                            <i class="fas fa-star mr-2"></i>
                        </div>
                    @elseif($item === 'text')
                        <h2 class="text-center mb-3" style="color: {{ $textColor }}">{{ $textValue }}</h2>
                    @elseif($item === 'input')
                        <input type="text" class="form-control mb-3" :placeholder="{{ $inputPlaceholder }}">
                    @elseif($item === 'button')
                        <button class="btn btn-dark btn-lg btn-block text-uppercase mb-3">{{ $buttonText }}</button>
                    @endif
                @endforeach

                    <p>
                        No credit card is required. No Surprises
                    </p>
            </div>
        </div>
    </div>
</div>

</body>
</html>