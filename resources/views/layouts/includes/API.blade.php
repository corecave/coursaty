<script>
    window.API = {
        user: {
            index: "{{ route('user.index') }}",
            store: "{{ route('user.store') }}",
            update: "{{ route('user.update', ['user' => 'ID']) }}"
        },
        category: {
            index: "{{ route('category.index') }}",
            store: "{{ route('category.store') }}",
            update: "{{ route('category.update', ['category' => 'ID']) }}"
        },
        course: {
            index: "{{ route('course.index') }}",
            store: "{{ route('course.store') }}",
            update: "{{ route('course.update', ['course' => 'ID']) }}",
        },
    };

</script>
