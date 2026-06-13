<x-dashboard title="All Products">


    {{-- <h1 style= "top: 10%; left: 17%; position: absolute;">All Products </h1> --}}



    <a class="back-button" href="{{ route('admin.products.create') }} ">
        {{-- <button > --}}
        <i class="fas fa-plus"></i>
        <span>Add New</span>

        {{-- </button> --}}
    </a>





    <section class="all-cart-section coupons-page">
        <div class="container">

            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>

                <tbody>
                    <tr>
                        @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img width="100" height="100" class="table-img" src="{{ $product->img_path }}" />
                        </td>
                        <td><span class="table-title">{{ $product->name }}</span></td>
                        <td> ${{ number_format($product->price,2) }}</td>
                        <td> {{ $product->quantity }}</td>
                        <td> {{ $product->role?->name }}</td>
                        <td class="actions">
                            <a class="update" href="{{ route('admin.products.gallery', $product->id) }}" style="margin-right: 5px;">
                                <button type="button">
                                    <i class="fa-solid fa-images"></i> Gallery
                                </button>
                            </a>
                            <a class="update" href="{{ route('admin.products.edit', $product->id) }} ">
                                <button><i class="fas fa-edit"></i>Edit</button>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                style="display: inline; margin-left: 5px;">
                                @csrf
                                @method('DELETE')
                                <a href="" class="delete"><button type="submit"
                                        onclick="return confirm('Are You Sure?')"> <i class="fas fa-trash"></i>Delete</button></a>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center "> No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>

        </div>

    </section>


    {{ $products->links() }}
</x-dashboard>