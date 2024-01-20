@extends('layouts.app')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class=" border sm:mx-auto sm:w-full sm:max-w-md p-4 shadow-md">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Offer Created</h2>
              </div>
            
              <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm ">
                  {{ Form::open([
                    'url' => route('offers.store'),
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data'
                  ])}}
                  {{-- <form action="{{ route('offers.store') }}" method="post" enctype="multipart/form-data"> --}}
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Title<span class=" text-red-600 font-bold">*</span></label>
                        <div class="mt-2">
                          <input id="title" name="title" value="{{ old('title')}}" type="text" autocomplete="title" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                          @error('title')
                            <p class=" text-red-700 p-2">{{ $message }}</p>
                          @enderror
                        </div>
                      </div>
                    <div>
                      <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Price<span class=" text-red-600 font-bold">*</span></label>
                      <div class="mt-2">
                        <input id="price" name="price" value="{{ old('price')}}" type="number" autocomplete="price" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                                  <option {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }} class=" border-t-2" value="{{ $category->id}}">{{ $category->title}}</option>
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
                                <option {{ in_array($location->id, old('locations', [])) ? 'selected' : '' }}  class=" border-t-2" value="{{ $location->id}}">{{ $location->title}}</option>
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
                        <img class=" object-cover rounded-3xl" src="{{ asset(\App\Models\Offer::PLACEHOLDER_IMAGE_PATH) }}" alt=""> 
                      </div>
                      <input id="image" name="image" type="file" value="{{ old('image')}}" autocomplete="title" class="image-upload-input block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="">
                    </div>

                  <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Description<span class=" text-red-600 font-bold">*</span></label>
                    <div class="mt-2">
                        <textarea name="description" value="{{ old('description')}}" id="" cols="30" rows="5" autocomplete="description" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        @error('title')
                        <p class=" text-red-700 p-2">{{ $description }}</p>
                      @enderror
                  </div>
            
                  <div class=" pt-4">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
                  </div>
                {{ Form::close() }}
                {{-- </form> --}}
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