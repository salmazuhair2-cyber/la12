<x-dashboard title="Add New Product">

    {{-- <h1 style="top: 10%; left: 17%; position: absolute;">Add New Product</h1> --}}
    <a class="back-button" href="{{ route('admin.products.index') }}">
        <i class="fas fa-long-arrow-left"></i>
        <span>All Products</span>
    </a>
    <section class="addProduct">
        <div class="spacial-content"></div>
        <div class="container">
            <div class="product-group">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
                    class="form grid">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-row">
                        <div class="form-item">
                            <label>Name</label>
                            <input type="text" name="name"
                                class="form-control form-input @error('name') is-invalid @enderror" placeholder="Name"
                                value="{{ old('name') }}" />
                            @error('name')
                            <div class="alert alert-danger mt-2 p-2">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Field -->

                    <div class="form-row">
                        <div class="form-item">
                            <label>Image</label>
                            <input type="file" onchange="showImg(event, 'previewProductImg')" name="image"
                                class="form-input @error('image') is-invalid @enderror" />
                            @error('image')
                            <div class="alert alert-danger mt-2 p-2">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror

                            <img width="150" height="120" id="previewProductImg"
                                src="{{ $product->image ? $product->img_path : '' }}" alt=""
                                style="display: {{ $product->image ? 'block' : 'none' }}">
                        </div>





                    </div>

                    <div class="form-row ">
                        <div class="form-item ">
                            <label>Gender</label>
                            <div class="form-row" style="display: flex; gap: 20px;">
                                @foreach ($genders as $value => $label)
                                <div class="gender">
                                    <input type="radio" id="gender_{{ $value }}" name="gender"
                                        value="{{ $value }}  @checked($value=old('gender'))" />
                                    <label for="gender_{{ $value }}">{{ $label }}</label>
                                </div>
                                @endforeach
                            </div>

                            @error('gender')
                            <div class="alert alert-danger mt-2 p-2">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>


                    <!-- Description Field -->
                    <div class="form-row">
                        <div class="form-item">
                            <label>Description</label>
                            <textarea name="description" class="form-input @error('description') is-invalid @enderror" placeholder="Description"
                                cols="15" rows="1">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2 p-2">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-col" style="display: flex; align-items: center; gap: 5%;">

                        <div class="form-row">
                            <div class="form-item">
                                <div class="input-wrapper" style="position: relative; width: 360px;">
                                    <label>Price</label>
                                    <input type="number" name="price" value="{{ old('price') }}"
                                        class="form-input @error('price') is-invalid @enderror" />
                                    @error('price')
                                    <div class="alert alert-danger mt-2 p-2">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-row">
                            <div class="form-item">
                                <div class="input-wrapper" style="position: relative; width: 360px;">
                                    <label>Quantity</label>
                                    <input type="number" name="quantity" value="{{ old('quantity') }}"
                                        class="form-input @error('quantity') is-invalid @enderror" />
                                    @error('quantity')
                                    <div class="alert alert-danger mt-2 p-2">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-item">
                                <div class="input-wrapper" style="position: relative; width: 360px;">
                                    <label>Category</label>
                                    <select name="category_id"
                                        class="form-input @error('category_id') is-invalid @enderror">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="alert alert-danger mt-2 p-2">
                                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-item add">
                            <button type="submit" class="add">➕ Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </section>

    @push('scripts')
    <script>
        function showImg(event, previewId = 'previewProductImg') {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                    preview.style.width = '150px';
                    preview.style.maxHeight = '120px';
                    preview.style.objectFit = 'contain';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }
    </script>
    @endpush
</x-dashboard>