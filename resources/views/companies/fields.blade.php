<!-- User Id Field -->
<div class="form-group col-sm-6" style="display:none">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', Auth::user()->id, ['class' => 'form-control','required' => 'required']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6" id="div-name">
    {!! Form::label('name', 'Company Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 200,'required' => 'required']) !!}
</div>

<!-- Zipcode Field -->
<div class="form-group col-sm-6" id="div-zipCode">
    {!! Form::label('zipCode', 'Zipcode:') !!}
    {!! Form::text('zipCode', null, ['class' => 'form-control','maxlength' => 9,'required' => 'required']) !!}
</div>

<!-- Street Field -->
<div class="form-group col-sm-6" style="display:none" id="div-street">
    {!! Form::label('street', 'Street:') !!}
    {!! Form::text('street', null, ['class' => 'form-control','maxlength' => 255,'required' => 'required']) !!}
</div>

<!-- District Field -->
<div class="form-group col-sm-6" style="display:none" id="div-district">
    {!! Form::label('district', 'District:') !!}
    {!! Form::text('district', null, ['class' => 'form-control','maxlength' => 255,'required' => 'required']) !!}
</div>

<!-- City Field -->
<div class="form-group col-sm-6" style="display:none" id="div-city">
    {!! Form::label('city', 'City:') !!}
    {!! Form::text('city', null, ['class' => 'form-control','maxlength' => 255,'required' => 'required']) !!}
</div>

<!-- State Field -->
<div class="form-group col-sm-6" style="display:none" id="div-state">
    {!! Form::label('state', 'State:') !!}
    {!! Form::text('state', null, ['class' => 'form-control','maxlength' => 2,'required' => 'required']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6" id="div-phone">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'pattern' => '\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}','maxlength' => 15]) !!}
</div>

<!-- Complement Field -->
<div class="form-group col-sm-6" id="div-complement">
    {!! Form::label('complement', 'Complement:') !!}
    {!! Form::text('complement', null, ['class' => 'form-control','maxlength' => 255]) !!}
</div>
<input id="route" style="display: none;" value="{{route('getAddress')}}">

<!-- Number Home Field -->
<div class="form-group col-sm-6" id="div-number_home">
    {!! Form::label('number_home', 'Number Home:') !!}
    {!! Form::number('number_home', null, ['class' => 'form-control','min' => 0,'required' => 'required']) !!}
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js" integrity="sha512-yVcJYuVlmaPrv3FRfBYGbXaurHsB2cGmyHr4Rf1cxAS+IOe/tCqxWY/EoBKLoDknY4oI1BNJ1lSU2dxxGo9WDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('/js/validation-script.js')}}"></script>
