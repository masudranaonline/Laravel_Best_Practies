@extends('layouts.app')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class=" border sm:mx-auto sm:w-full sm:max-w-md p-4 shadow-md">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Offer Created</h2>
              </div>
            
              <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm ">
                  {{-- {{ Form::open([
                    'url' => route('offers.update', $offer->id),
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data'
                  ])}} --}}
                  <form action="{{ route('offers.update', $offer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Title<span class=" text-red-600 font-bold">*</span></label>
                        <div class="mt-2">
                          <input id="title" name="title" value="{{ old('title', $offer->title)}}" type="text" autocomplete="title" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          @error('title')
                            <p class=" text-red-700 p-2">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                    <div>
                      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Price<span class=" text-red-600 font-bold">*</span></label>
                      <div class="mt-2">
                        <input id="price" name="price" value="{{ old('price', $offer->price) }}" type="number" autocomplete="price" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        @error('price')
                        <p class=" text-red-700 p-2">{{ $message }}</p>
                      @enderror
                      </div>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Category<span class=" text-red-600 font-bold">*</span></label>
                        <div class="mt-2">
                            <select name="categories[]" id="select-category" multiple autocomplete="off" value="{{ old('categories[]')}}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Choose Option</option>
                                @foreach ($categories as $category )
                                  <option {{ in_array($category->id, old('categories', $offer->categories->pluck('id')->toArray())) ? 'selected' : '' }} class=" border-t-2" value="{{ $category->id}}">{{ $category->title}}</option>
                                @endforeach
                          </select>
                          @error('category')
                          <p class=" text-red-700 p-2">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                  <div>
                      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Location<span class=" text-red-600 font-bold">*</span> </label>
                      <div class="mt-2">
                          <select name="locations[]" id="select-location" multiple autocomplete="off" value="{{ old('locations[]')}}" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <option value="">Choose Option</option>
                              @foreach ($locations as $location )
                                <option {{ in_array($location->id, old('locations', $offer->locations->pluck('id')->toArray())) ? 'selected' : '' }}  class=" border-t-2" value="{{ $location->id}}">{{ $location->title}}</option>
                              @endforeach
                        </select>
                        @error('location')
                        <p class=" text-red-700 p-2">{{ $message }}</p>
                      @enderror
                      </div>
                  </div>

                    <div class="mt-2 flex flex-col image-preview">
                      <label for="email" class="leading-loose">Image</label>
                      <div class="flex items-center justify-center p-4">
                        <img class=" object-cover rounded-3xl" src="{{ asset($offer->image_url) }}" alt=""> 
                      </div>
                      <input id="image" name="image" type="file" value="{{ old('image')}}" autocomplete="title" class="image-upload-input block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="">
                    </div>

                  <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Description<span class=" text-red-600 font-bold">*</span></label>
                    <div class="mt-2">
                        <textarea name="description" value="" id="" cols="30" rows="5" autocomplete="description" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            {{ old('description', $offer->description)}}
                        </textarea>
                        @error('title')
                        <p class=" text-red-700 p-2">{{ $description }}</p>
                      @enderror
                  </div>

                  
            
                  <div class="pt-4 flex items-center space-x-4">
                    <a href="{{ auth()->user()->isAdmin() ? route('offers.index') : route('offers.my') }}" class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Cancel
                    </a>
                    <button class="bg-green-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Update</button>
                </div>
                {{-- {{ Form::close() }} --}}
                </form>
              </div>
        </div>
    </div>

@endsection

@section('script')
    @include('layouts.scripts.image-uploaded-preview-script')

    <script>
         $(document).ready(function() {
        new TomSelect("#select-category",{
            plugins: ['remove_button'],
            maxItems: 5,
            onItemAdd:function(){
                this.setTextboxValue('');
            },
        });

        new TomSelect("#select-location",{
            plugins: ['remove_button'],
            maxItems: 5,
            onItemAdd:function(){
                this.setTextboxValue('');
            },
        });
    });
    </script>
@endsection

</body>
</html>