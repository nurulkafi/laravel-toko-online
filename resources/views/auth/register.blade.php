@extends('user.layout.main')

@section('content')
  <!-- Content -->
  <div id="content">

    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-100 padding-bottom-100">
      <div class="container">

        <!-- Payments Steps -->
        <div class="shopping-cart">

          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info register">
            <div class="row">

              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-12">
                <h6>REGISTER</h6>
                <form action="{{ url('user/register') }}" method="POST">
                    @csrf
                  <ul class="row">

                    <!-- Name -->
                    <li class="col-md-6">
                      <label> *FIRST NAME
                        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="">
                      </label>
                      @error('first_name')
                        {{ "*".$message }}
                      @enderror
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *EMAIL ADDRESS
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="">
                      </label>
                      @error('email')
                        {{ "*".$message }}
                      @enderror
                    </li>
                    <li class="col-md-6">
                      <label> *LAST NAME
                        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="">
                      </label>
                      @error('last_name')
                        {{ "*".$message }}
                      @enderror
                    </li>

                    <!-- PHONE -->
                    <li class="col-md-6">
                      <label> *PASSWORD
                        <input type="password" name="password" value="{{ old('password') }}" placeholder="">
                      </label>
                       @error('password')
                        {{ "*".$message }}
                       @enderror
                    </li>
                    <li class="col-md-6">
                      <label> *PHONE
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="">
                        </label>
                    @error('phone')
                        {{ "*".$message }}
                    @enderror
                    </li>

                    <!-- LAST NAME -->

                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *CONFIRM-PASSWORD
                        <input type="password" name="confirmed-password" value="" placeholder="">
                      </label>
                      @error('confirmed-password')
                        {{ "*".$message }}
                    @enderror
                    </li>
                    <li class="col-md-6">
                        <!-- ADDRESS -->
                        <label>*PROVINCE
                            <select name="" id="provinsiTujuan"  class="selectpicker">
                                      @foreach ($province as $item)
                                          <option value="{{ $item->code }}">{{ $item->title }}</option>
                                      @endforeach
                            </select>
                        </label>
                    </li>
                    <li class="col-md-6">
                      <!-- ADDRESS -->
                      <label>*CITY
                        <select name="city_id" id="kotaTujuan"  class="selectpicker">
                                    <option value="{{ old('first_name') }}">&nbsp;</option>
                        </select>
                      </label>
                    </li>

                    <!-- COUNTRY -->
                    <li class="col-md-12">
                      <label> *ADDRESS
                        <textarea name="address" style="border: 0.5px solid black;border-radius: 0%;margin-top:10px" class="form-control" name="address" id="message" rows="5" placeholder="">{{ old('address') }}</textarea>
                      </label>
                    </li>



                    <!-- PHONE -->
                    <li class="col-md-6">
                      <button type="submit" class="btn">REGISTER NOW</button>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@push('detailproduct')
<script>
    $(document).ready(function () {
        $('#provinsiTujuan').on('change',function(){
            let id = $(this).val();
                $.ajax({
                    url: '/province/search/'+id,
                    type: 'get',
                    dataType: 'json',
                    success:function(data) {
                        $('#kotaTujuan').empty();
                        $.each(data, function(key, value){
                            $('#kotaTujuan').append(`<option value="${key}"> ${value} </option>`);
                        });
                        $('#kotaTujuan').selectpicker('refresh');
                },
                });
        });
    });
</script>
@endpush
@endsection
