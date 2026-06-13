<x-dashboard title="All Users">
    <h1 style="top: 10%; left: 17%; position: absolute;">All Users</h1>

    @include('components.alert')

    <a class="back-button" href="{{ route('admin.users.create') }}">
        <i class="fas fa-plus"></i>
        <span>Add New</span>
    </a>

    <section class="all-cart-section">
        <div class="container">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    @if(auth()->user()->is_super_admin)

                    <th>Actions</th>
                    @endif
                </tr>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($user->avatar)
                            <img width="100" height="100" class="table-img" src="{{ asset('images/' . $user->avatar) }}" />
                            @else
                            <span>No Avatar</span>
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->getRoleLabel()) }}</td>
                        @if(auth()->user()->is_super_admin)
                        <td class="actions">
                            <a class="update" href="{{ route('admin.users.edit', $user->id) }}">
                                <button><i class="fas fa-edit"></i>Edit</button>
                            </a>

                            <form id="delete-user-{{ $user->id }}"
                                action="{{ route('admin.users.destroy', $user->id) }}"
                                method="POST"
                                style="display:none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <a href="#" class="delete" onclick="confirmDelete('delete-user-{{ $user->id }}'); return false;">
                                <button type="button">
                                    <i class="fas fa-trash"></i>Delete
                                </button>
                            </a>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td @if(auth()->user()->is_super_admin) colspan="6" @else colspan="5" @endif class="text-center">No Users Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{ $users->links() }}
</x-dashboard>