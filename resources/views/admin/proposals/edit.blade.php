@extends('layouts.app')
@section('page_title')
{{-- <span>Update department</span> --}}
@endsection
@section('content')

<form action="{{ url('admin/proposal/'.$contacts->id) }}" method="post">
              @csrf
              @method("PATCH")
       <div class="form-row">
         <div class="form-group col-md-4">





            <label for="customer name">Company Name</label>


               <select  class="form-control" id="item" name='customer_id'>
                         <option value="">Select Customer</option>
                     @foreach ($customers as $cust)
                      {{-- {{dd($contact->id)}} --}}
                      <option value="{{$cust->id}}"{{$contacts->customer_id == $cust->id ? 'selected' : '' }}>{{$cust->company_name}}</option>
                      @endforeach



               </select>
               @error('customer_id')
<span style="color: red">{{ $message }}</span>
@enderror
            </div>
            <div class="form-group col-md-4" >
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id=""  value="{{$contacts->date}}">
             @error('date')
                     <span style="color: red">{{ $message }}</span>
                     @enderror

            </div>
                 <div class="form-group col-md-4">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" name="due_date" id="" value="{{$contacts->due_date}}" >
            @error('due_date')
                     <span style="color: red">{{ $message }}</span>
                     @enderror
             </div>
            <div class="form-group col-md-6">

            <label for="subject">Subject</label>
            <textarea type="text"  rows="4" cols="35" class="form-control" name="subject" id=""  placeholder="Enter your subject ">{{$contacts->subject}}</textarea>
              @error('subject')
                     <span style="color: red">{{ $message }}</span>
                     @enderror
            </div>

            <div class="form-group col-md-6">
             <label for="customer name">Assigned</label>
              <select  class="form-control" class='custom-select' id="item" name='user_id[]' multiple>
                 <option value="user">User</option>
                      @foreach ($user as $p)
                  <option value="{{$p->id}}" @foreach ($edit_user as $us){{($us->user->id == $p->id) ? 'selected': ''}}

                  @endforeach>{{$p->name}}</option>
              @endforeach
              </select>
            </div>

           </div>


  {{-- {{$contacts->customers->user->name == $p->name ? 'selected' : '' }} --}}



                        {{-- {{dd($data)}} --}}
                           <select name="" onchange="get_product(this.value)"  class="form-control">
                              <option value="">Select Item</option>
                             @foreach($item as $row )
                              <option value={{$row->id}} >
                                {{$row->name}}
                              </option>
                             @endforeach
                           </select>

               <div role="alert" id="errorMsg" class="mt-5" >
                 <!-- Error msg  -->
              </div>
            </div>
            <div class="" style="background-color:#f5f5f5;">
               <div class="row">
                     </span>
                     <table id="mytable" class="table-bordered">
                        <thead>
                         <th>Name</th>
                         <th></th>
                         <th>Rate</th>
                         <th>Qty</th>
                         <th>Tax</th>
                         <th>Total</th>
                         <th>Action</th>
                        </thead>
                        <tbody id="kk">

                           @foreach ($ProposalItem as $ProItem)
                               <tr>
                                 <td>{{$ProItem->Item->name}}</td>
                                 <td><input type='hidden' name='item_id[]'  type='text' value='{{$ProItem->item_id}}'></td>
                                 <td> <input  type='text' class='rate' name='price[]' value='{{$ProItem->price}}'></td>
                                 <td><input type='text' name='qty[]' class='qty' value='{{$ProItem->qty}}'></td>
                                 <td><input type='text' class='tax'  value='{{$ProItem->Item->Tax->rules}}'></td>
                                 <td class='text-center total'><input type='text' value='{{$ProItem->price*$ProItem->qty}}'></td>
                                 <td><span  id='DeleteButton'><i class='fas fa-trash-alt'></i></span></td>
                              </tr>
                                 @endforeach
                        </tbody>

                </table>


                           <div class="col-md-12 offset-9">
                             <td colspan='5' class="text-right ">Total: </td>
                             <td colspan='1'></td><input type="number" class="sub_total" readonly></td>
                            </div>



                  </div>

            <div class="form-row">
				<strong>&nbsp;</strong>
				<input type="submit" value="SUBMIT" class="form-control btn-primary btn-block">
			</div>
		</form>

<script>

   function get_product(id){
      var url="{{URL::to('admin/getPrice/')}}"
           $.ajax({
           type:'GET',
           url:url+'/'+id,
           dataType:'json',
           success:function(data)
             {

                // var rate= parseInt(data.rate);
				// 	var tax= parseInt(data.tax);
				// 	var t_rate=(rate/100)*tax;
				// 	var total= rate+t_rate;

                console.log(typeof(data));
                var rate= parseInt(data.rate);
                var total_rate= parseInt(rate*data.qty);
							var tax= parseInt(data.tax);
							var t_rate=(rate/100)*tax;
							var total= rate+t_rate;



               let ht="<tr><td>"+data.name+"</td> <td><input type='hidden' name='item_id[]'  type='text' value='"+ data.id +"'></td><td><input  type='text' class='rate' name='price[]' value='"+data.rate+"'></td><td><input type='text' name='qty[]' class='qty' value='1'></td><td><input type='text' class='tax'  value='"+data.tax+"'></td><td><input class='total' readonly type='number' name='' value='"+total+"'></td><td><span  id='DeleteButton'><i class='fas fa-trash-alt'></i></span></td></tr>";
               $('#kk').append(ht);
               calculate_sub();
             }
        });
   }
   $(".table-bordered").on('keyup','.qty,.rate,.tax', function() {
                    var qty = $(this).closest('tr').find('.qty').val();
                    var rate = $(this).closest('tr').find('.rate').val();
                    var tax = $(this).closest('tr').find('.tax').val();
						var t_rate=(rate/100)*tax;
						var total= (rate*qty)+(t_rate*qty);
						$(this).closest('tr').find('.total').val(total)
						calculate_sub();
				})

            $("#mytable").on("click", "#DeleteButton", function() {
                       $(this).closest("tr").remove();
					   calculate_sub();
               });

				calculate_sub = function() {
                    var s = 0;
                    $(".qty").closest('tr').each(function(index, value) {
                         var ss = parseInt($(this).find('.total').val());

                         s += ss;

                         console.log();
                         $(".sub_total").val(s);
                    });
               }
</script>
@endsection
