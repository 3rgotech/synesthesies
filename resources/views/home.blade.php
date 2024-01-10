<x-guest-layout>
    <div class="container mx-auto lg:h-screen flex flex-col justify-center items-center">
        <h1 class="text-7xl">
            <strong class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-500">
                {{ config('app.name') }}
            </strong>
        </h1>
        <p>
            <abbr title="netlify cms, eleventy, alpine js &amp; tailwind css">NEAT</abbr> Starter Template. Get
            Started
            by editing. <code class="bg-gray-100 text-blue-800 p-1">/index.njk</code>
        </p>
        <div class="w-full max-w-2xl grid grid-cols-1 lg:grid-cols-2 gap-4 my-8 px-4 lg:mx-0">
            <a href="https://www.netlifycms.org/" target="_blank"
                class="p-5 border rounded border-gray-200 hover:border-purple-400">
                <h3>Netlify CMS →</h3>
                <p>Open source content management for your Git workflow</p>
            </a>
            <a href="https://www.11ty.dev/" target="_blank"
                class="p-5 border rounded border-gray-200 hover:border-purple-400">
                <h3>Eleventy →</h3>
                <p>Eleventy is a simpler static site generator.</p>
            </a>
            <a href="https://github.com/alpinejs/alpine" target="_blank"
                class="p-5 border rounded border-gray-200 hover:border-purple-400">
                <h3>Alpine.js →</h3>
                <p>A minimal framework for composing JavaScript behavior in your markup.</p>
            </a>
            <a href="https://tailwindcss.com/" target="_blank"
                class="p-5 border rounded border-gray-200 hover:border-purple-400">
                <h3>Tailwind CSS →</h3>
                <p>A utility-first CSS framework for rapidly building custom designs.</p>
            </a>
        </div>
    </div>
</x-guest-layout>
