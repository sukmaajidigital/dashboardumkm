<x-layouts>
    <h1>Dashboard</h1>
    <x-forms.text-input label="Full Name" placeholder="John Doe" id="fullName" name="fullName" />
    <x-forms.text-input label="Email" placeholder="example@email.com" id="email" type="email" name="email" />
    <x-forms.select-input label="Pick your favorite Movie" id="favorite-movie" name="favoriteMovie" :options="['The Godfather', 'The Shawshank Redemption', 'Pulp Fiction', 'The Dark Knight', 'Schindler\'s List']" />
    <x-forms.textarea-input label="Your bio" placeholder="Hello!!!" id="bio" name="bio" />
</x-layouts>
