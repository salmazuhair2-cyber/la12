<x-dashboard>
    <h1 style="top: 10%; left: 17%; position: absolute;">Edit Category</h1>
    <a class="back-button" href="{{ route('admin.categories.index') }} ">
        <i class="fas fa-long-arrow-left"></i>
        <span>Back to Categories</span>
    </a>

    <section class="editProduct">
        <div class="spacial-content">

        </div>
        <div class="container">
            <div class="product-group">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="PUT" class="form grid" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-row">
                        <div class="form-item">
                            <label> Name</label>
                            <input type="text" name="name"
                                class="form-control form-input @error('name')
                            is-invalid @enderror" placeholder="Name"
                                value="{{ old('name', $category->name) }}" />
                            @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-item">
                            <label for="productImage">Image:</label>
                            <input type="file" id="productImage" class="form-input">
                            <img src="{{ asset('storage/categories/' . $category->image) }}" alt="Category Image" width="100" height="100">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-item">
                            <label>Description</label>
                            <textarea name="description" class="form-input @error('description')
                            is-invalid @enderror"
                                placeholder="Description" cols="30" rows="5">{{ old('description', $category->description) }}</textarea>

                            @error('description')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-item add ">
                            <button type="submit" class="add ">✍️ Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </section>
    <!-- ------------End of Profile-------------------->

</x-dashboard><x-dashboard>
    <h1 style="top: 10%; left: 17%; position: absolute;">Add New Categories </h1>
    <a class="back-button" href="{{ route('admin.categories.index') }} ">
        {{-- <button > --}}
        <i class="fas fa-long-arrow-left"></i>
        <span>Edit Category</span>
    </a>

    <section class="addProduct">
        <div class="spacial-content">

        </div>
        <div class="container">
            <div class="product-group">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="PUT" class="form grid">
                    @csrf
                    <div class="form-row">
                        <div class="form-item">
                            <label> Name</label>
                            <input type="text" name="name"
                                class="form-control form-input @error('name')
                            is-invalid @enderror" placeholder="Name"
                                value="{{ old('name') }}" />
                            @error('name')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-item">
                            <label for="productImage">Image:</label>
                            <input type="file" id="productImage" class="form-input">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-item">
                            <label>Description</label>
                            <textarea name="description" class="form-input @error('description')
                            is-invalid @enderror"
                                placeholder="Description" cols="30" rows="5">{{ old('description') }}</textarea>

                            @error('description')
                            <small class="invalid-feedback">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-item add ">
                            <button type="submit" class="add ">➕ Add</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </section>
    <!-- ------------End of Profile-------------------->





</x-dashboard>