<div class="py-3 px-4 flex items-center text-sm font-medium leading-none text-gray-600 cursor-pointer rounded">
    <p>Filter:</p>
    <select id="categoryDropdownFilter" aria-label="select"
        class="focus:text-indigo-600 focus:outline-none bg-transparent ml-1 capitalize">
        <option value="all" selected class="text-sm text-indigo-800">All</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" class="text-sm text-indigo-800 capitalize"
                @if (request('category') == $category->id) selected @endif>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<script>
    const categoryDropdownFilter = document.getElementById('categoryDropdownFilter');

    categoryDropdownFilter.addEventListener('change', function(e) {
        const selectedValue = e.target.value;

        if (selectedValue === "all") {
            // If "All" is selected, remove the 'category' query parameter from the URL
            removeCategoryParam();
        } else {
            // If a specific category is selected, update the 'category' query parameter
            const currentUrl = window.location.href;
            const url = new URL(currentUrl);
            url.searchParams.set('category', selectedValue);
            window.location.href = url.toString();
        }
    });

    // Function to remove the 'category' query parameter from the URL
    function removeCategoryParam() {
        const currentUrl = window.location.href;
        const url = new URL(currentUrl);
        url.searchParams.delete('category');
        window.location.href = url.toString();
    }
</script>
