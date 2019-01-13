<div class="form-group  col-md-6 col-xs-12">
    <label class="col-sm-12 col-form-label">{{ $label }}</label>
    <div class="col-sm-12">
        <input type="text" {{ $readonly ? "readonly" : ""  }} name="{{ $name ?? $name  }}" class="form-control" value="{{ $value }}">
    </div>
</div>