@extends('home.layouts.master')
@extends('home.layouts.navbar')
@section('content')


<div class="container" style="margin-top: 2%">
    <div class="row">
        <div class="col-12">
            <div class="card" style="margin: 5%">
                <div class="card-header">
                    <div class="text-center">
                        <img src="https://cdn.mobilepulsa.net/img/logo/pulsa/small/indosat.png" alt="">
                        <img src="https://cdn.mobilepulsa.net/img/logo/pulsa/small/xl.png" alt="">
                        <img src="https://cdn.mobilepulsa.net/img/logo/pulsa/small/axis.png" alt="">
                        <img src="https://cdn.mobilepulsa.net/img/logo/pulsa/small/telkomsel.png" alt="">
                        <img src="https://cdn.mobilepulsa.net/img/logo/pulsa/small/smart.png" alt="">
                        <img src="https://cdn.mobilepulsa.net/img/logo/pulsa/small/three.png" alt="">
                        <img src="https://cdn.mobilepulsa.net/img/product/operator_list/121121035421-byu-logo.png" alt="">
                    </div>

                </div>
                <div class="card-body">
                    <form action="/2">
                        <label for="">No Hp</label>
                        <input  id="hp" onkeyup="selesai()" name="nohp" type="number" class="form-control">
                        {{-- <div class=""> --}}
                            <div  class=  "row hide"  >
                                {{-- <button style="padding: 0;border: none;background: none;" type="submit" onclick="confir()" style="text-decoration: none;color:black" >
                                    <input type="hidden" value="${y.product_code}">
                                    <div class=  "col-12"  >
                                        <div  class=  "card"  style=  "margin-top: 2%"  >
                                            <div  class=  "card-body"  >
                                                <div class="row">
                                                    <div class="col-6 text-start" style="padding:20px">
                                                        ${y.product_description} ${y.product_nominal}
                                                    </div>
                                                    <div class="col-6 text-end" style="padding:20px">
                                                        ${y.product_price}
                                                    </div>

                                                    <div class="col text-start" style="padding:20px">
                                                    pulsa ${y.product_description} ${y.product_nominal}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </button> --}}
                            </div>

                        {{-- </div> --}}

                        <br>
                        <button id="buttom" type="submit" class="btn btn-primary">Add To cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    // $(document).ready(function(){

    //     // selesai()
    //     setInterval(() => {
    //         selesai()
    //     }, 1000);
    // });


    function selesai(){
        let isi = $('#hp').val()

        //three
        if(isi == '0896' || isi == '0895' || isi == '0897' || isi == '0899' || isi == '0899'){

            $.ajax({
                type : 'get',
                url : '/prefix/pulsa/Three',
                success : function(data){

                    $('.hide').empty();

                    $(data).each(function(x,y){
                        // console.log(y.category_id)
                        const rupiah = (number)=>{
                                return new Intl.NumberFormat("id-ID", {
                                }).format(number);
                        }

                        if(y.product_code == 'hthreeBEBAS150' || y.product_code == 'hthreeBEBAS250' || y.product_code == 'hthreeBEBAS60' ){

                            result =  `


                                        <div class=  "col-12"  >
                                            <div  class=  "card"  style=  "margin-top: 2%"  >
                                                <div  class=  "card-body"  >
                                                    <div class="row">
                                                        <div class="col-6 text-start" style="padding:7px">
                                                            <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${y.product_nominal}
                                                        </div>
                                                        <div class="col-6 text-end" style="padding:7px">
                                                           Rp ${rupiah(y.product_price)}
                                                        </div>

                                                        <div class="col text-start" style="padding:7px">
                                                        ${y.product_description} ${y.product_nominal}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            `;

                        } else {
                            result =  `


                                        <div class=  "col-12"  >
                                            <div  class=  "card"  style=  "margin-top: 2%"  >
                                                <div  class=  "card-body"  >
                                                    <div class="row">
                                                        <div class="col-6 text-start" style="padding:7px">
                                                            <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${rupiah(y.product_nominal)}
                                                        </div>
                                                        <div class="col-6 text-end" style="padding:7px">
                                                           Rp ${rupiah(y.product_price)}
                                                        </div>

                                                        <div class="col text-start" style="padding:7px">
                                                        Pulsa ${y.product_description} Rp ${rupiah(y.product_nominal)}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            `;

                        }

                        $('.hide').append(result);
                    });

                    $('#product').empty();



                },
            });


        } else if(isi == '085154' || isi == '085155' || isi == '085156' || isi == '085157' || isi == '085158'){
            //byu

            $.ajax({
                type : 'get',
                url : '/prefix/pulsa/By.U',
                success : function(data){

                    $('.hide').empty();

                    $(data).each(function(x,y){
                        // console.log(y.category_id)
                        const rupiah = (number)=>{
                                return new Intl.NumberFormat("id-ID", {
                                }).format(number);
                        }
                        result =  `


                                    <div class=  "col-12"  >
                                        <div  class=  "card"  style=  "margin-top: 2%"  >
                                            <div  class=  "card-body"  >
                                                <div class="row">
                                                    <div class="col-6 text-start" style="padding:7px">
                                                        <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${rupiah(y.product_nominal)}
                                                    </div>
                                                    <div class="col-6 text-end" style="padding:7px">
                                                       Rp ${rupiah(y.product_price)}
                                                    </div>

                                                    <div class="col text-start" style="padding:7px">
                                                    Pulsa ${y.product_description} Rp ${rupiah(y.product_nominal)}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        `;
                        $('.hide').append(result);
                    });

                    $('#product').empty();



                },
            });

        } else if(isi == '0881' || isi == '0882' || isi == '0883' || isi == '0884' || isi == '0885' || isi == '0886' || isi == '0887' || isi == '0888'){
            //smartfren

            $.ajax({
                type : 'get',
                url : '/prefix/pulsa/Smart',
                success : function(data){

                    $('.hide').empty();

                    $(data).each(function(x,y){
                        // console.log(y.category_id)
                        const rupiah = (number)=>{
                                return new Intl.NumberFormat("id-ID", {
                                }).format(number);
                            }
                        result =  `


                                    <div class=  "col-12"  >
                                        <div  class=  "card"  style=  "margin-top: 2%"  >
                                            <div  class=  "card-body"  >
                                                <div class="row">
                                                    <div class="col-6 text-start" style="padding:7px">
                                                        <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${rupiah(y.product_nominal)}
                                                    </div>
                                                    <div class="col-6 text-end" style="padding:7px">
                                                       Rp ${rupiah(y.product_price)}
                                                    </div>

                                                    <div class="col text-start" style="padding:7px">
                                                    Pulsa ${y.product_description} Rp ${rupiah(y.product_nominal)}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        `;
                        $('.hide').append(result);
                    });

                    $('#product').empty();



                },
            });

        } else if(isi == '0812' || isi == '0813' || isi == '0852' || isi == '0853' || isi == '0821' || isi == '0823' || isi == '082' || isi == '0851'){
            //telkomsel

            $.ajax({
                type : 'get',
                url : '/prefix/pulsa/Telkomsel',
                success : function(data){

                    $('.hide').empty();

                    $(data).each(function(x,y){
                        // console.log(y.category_id)
                        const rupiah = (number)=>{
                                return new Intl.NumberFormat("id-ID", {
                                }).format(number);
                            }

                            if(y.product_code == 'htelkomsel50000TEL' || y.product_code == 'htelkomsel5000SMS' || y.product_code == 'htelkomsel5000TEL' ){

                                result =  `


                                            <div class=  "col-12"  >
                                                <div  class=  "card"  style=  "margin-top: 2%"  >
                                                    <div  class=  "card-body"  >
                                                        <div class="row">
                                                            <div class="col-6 text-start" style="padding:7px">
                                                                <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${y.product_nominal}
                                                            </div>
                                                            <div class="col-6 text-end" style="padding:7px">
                                                            Rp ${rupiah(y.product_price)}
                                                            </div>

                                                            <div class="col text-start" style="padding:7px">
                                                            ${y.product_nominal}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                `;

                            } else {
                                result =  `


                                            <div class=  "col-12"  >
                                                <div  class=  "card"  style=  "margin-top: 2%"  >
                                                    <div  class=  "card-body"  >
                                                        <div class="row">
                                                            <div class="col-6 text-start" style="padding:7px">
                                                                <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${rupiah(y.product_nominal)}
                                                            </div>
                                                            <div class="col-6 text-end" style="padding:7px">
                                                            Rp ${rupiah(y.product_price)}
                                                            </div>

                                                            <div class="col text-start" style="padding:7px">
                                                            Pulsa ${y.product_description} Rp ${rupiah(y.product_nominal)}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                                `;

                            }
                        $('.hide').append(result);
                    });

                    $('#product').empty();



                },
            });

        } else if(isi == '0838' || isi == '0837' || isi == '0831' || isi == '0832'){
            //Axis

            $.ajax({
                type : 'get',
                url : '/prefix/pulsa/AXIS',
                success : function(data){

                    $('.hide').empty();

                    $(data).each(function(x,y){
                        // console.log(y.category_id)
                        const rupiah = (number)=>{
                                return new Intl.NumberFormat("id-ID", {
                                }).format(number);
                        }
                        result =  `


                                    <div class=  "col-12"  >
                                        <div  class=  "card"  style=  "margin-top: 2%"  >
                                            <div  class=  "card-body"  >
                                                <div class="row">
                                                    <div class="col-6 text-start" style="padding:7px">
                                                        <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${rupiah(y.product_nominal)}
                                                    </div>
                                                    <div class="col-6 text-end" style="padding:7px">
                                                       Rp ${rupiah(y.product_price)}
                                                    </div>

                                                    <div class="col text-start" style="padding:7px">
                                                    Pulsa ${y.product_description} Rp ${rupiah(y.product_nominal)}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        `;
                        $('.hide').append(result);
                    });

                    $('#product').empty();



                },
            });

        } else if(isi == '0817' || isi == '0818' || isi == '0819' || isi == '0859' || isi == '0878' || isi == '0877'){
                //XL

                $.ajax({
                    type : 'get',
                    url : '/prefix/pulsa/XL',
                    success : function(data){

                        $('.hide').empty();

                        $(data).each(function(x,y){
                            // console.log(y.category_id)
                            const rupiah = (number)=>{
                                    return new Intl.NumberFormat("id-ID", {
                                    }).format(number);
                                }

                                if(y.product_code == 'xld500AN90' || y.product_code == 'xld500AN30' || y.product_code == 'xld400AN7' || y.product_code == 'xld325AN30' || y.product_code == 'xld300AN90'){

                                    result =  `


                                                <div class=  "col-12"  >
                                                    <div  class=  "card"  style=  "margin-top: 2%"  >
                                                        <div  class=  "card-body"  >
                                                            <div class="row">
                                                                <div class="col-6 text-start" style="padding:7px">
                                                                    <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${y.product_nominal}
                                                                </div>
                                                                <div class="col-6 text-end" style="padding:7px">
                                                                Rp ${rupiah(y.product_price)}
                                                                </div>

                                                                <div class="col text-start" style="padding:7px">
                                                                ${y.product_nominal}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    `;

                                } else {
                                    result =  `


                                                <div class=  "col-12"  >
                                                    <div  class=  "card"  style=  "margin-top: 2%"  >
                                                        <div  class=  "card-body"  >
                                                            <div class="row">
                                                                <div class="col-6 text-start" style="padding:7px">
                                                                    <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${rupiah(y.product_nominal)}
                                                                </div>
                                                                <div class="col-6 text-end" style="padding:7px">
                                                                Rp ${rupiah(y.product_price)}
                                                                </div>

                                                                <div class="col text-start" style="padding:7px">
                                                                Pulsa ${y.product_description} Rp ${rupiah(y.product_nominal)}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    `;

                                }
                            $('.hide').append(result);
                        });

                        $('#product').empty();



                    },
                });

            } else if(isi == '0814' || isi == '0815' || isi == '0816' || isi == '0855' || isi == '0856' || isi == '0857' || isi == '0858'){
                //Indosat

                $.ajax({
                    type : 'get',
                    url : '/prefix/pulsa/Indosat',
                    success : function(data){

                        $('.hide').empty();

                        $(data).each(function(x,y){
                            // console.log(y.category_id)
                            const rupiah = (number)=>{
                                    return new Intl.NumberFormat("id-ID", {
                                    }).format(number);
                                }

                                if(y.product_code == 'hindosat5000SMS' || y.product_code == 'hindosat50000TEL' || y.product_code == 'hindosat25000SMS' || y.product_code == 'hindosat10000SMS'){

                                    result =  `


                                                <div class=  "col-12"  >
                                                    <div  class=  "card"  style=  "margin-top: 2%"  >
                                                        <div  class=  "card-body"  >
                                                            <div class="row">
                                                                <div class="col-6 text-start" style="padding:7px">
                                                                    <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${y.product_nominal}
                                                                </div>
                                                                <div class="col-6 text-end" style="padding:7px">
                                                                Rp ${rupiah(y.product_price)}
                                                                </div>

                                                                <div class="col text-start" style="padding:7px">
                                                                ${y.product_nominal}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    `;

                                } else {
                                    result =  `


                                                <div class=  "col-12"  >
                                                    <div  class=  "card"  style=  "margin-top: 2%"  >
                                                        <div  class=  "card-body"  >
                                                            <div class="row">
                                                                <div class="col-6 text-start" style="padding:7px">
                                                                    <input required name="code" value="${y.product_code}" type="radio"> ${y.product_description} ${rupiah(y.product_nominal)}
                                                                </div>
                                                                <div class="col-6 text-end" style="padding:7px">
                                                                Rp ${rupiah(y.product_price)}
                                                                </div>

                                                                <div class="col text-start" style="padding:7px">
                                                                Pulsa ${y.product_description} Rp ${rupiah(y.product_nominal)}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    `;

                                }
                            $('.hide').append(result);
                        });

                        $('#product').empty();



                    },
                });

            }
        }

        // $('.hide').empty();
        // $('#buttom').prop('disabled', true);


</script>

<br><br><br>
@endsection
