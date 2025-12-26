@extends('etudiantLayout.app')

@section('page_title', 'Espaces pédagogiques') 

@section('content')
@php
    $espaces->nom;
@endphp
    <div class="bg-gray-100 p-4 sm:p-8 md:p-16 mt-20">
  <div class="container mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

      <a href="/frontend-performance"
        class="relative flex h-full flex-col rounded-md border border-gray-200 bg-white p-2.5 hover:border-gray-400 sm:rounded-lg sm:p-5">
        <span class="text-md mb-0 font-semibold text-gray-900 hover:text-black sm:mb-1.5 sm:text-xl">
          Frontend Performance
        </span>
        <span class="text-sm leading-normal text-gray-400 sm:block">
          Detailed list of best practices to improve your frontend performance
        </span>
      </a>
      <a href="/api-security"
        class="relative flex h-full flex-col rounded-md border border-gray-200 bg-white p-2.5 hover:border-gray-400 sm:rounded-lg sm:p-5">
        <span class="text-md mb-0 font-semibold text-gray-900 hover:text-black sm:mb-1.5 sm:text-xl">
          API Security
        </span>
        <span class="text-sm leading-normal text-gray-400 sm:block">
          Detailed list of best practices to make your APIs secure
        </span>
      </a>
      <a href="/code-review"
        class="relative flex h-full flex-col rounded-md border border-gray-200 bg-white p-2.5 hover:border-gray-400 sm:rounded-lg sm:p-5">
        <span class="text-md mb-0 font-semibold text-gray-900 hover:text-black sm:mb-1.5 sm:text-xl">
          Code Reviews
        </span>
        <span class="text-sm leading-normal text-gray-400 sm:block">
          Detailed list of best practices for effective code reviews and quality
        </span>
      </a>
      <a href="/aws"
        class="relative flex h-full flex-col rounded-md border border-gray-200 bg-white p-2.5 hover:border-gray-400 sm:rounded-lg sm:p-5">
        <span class="text-md mb-0 font-semibold text-gray-900 hover:text-black sm:mb-1.5 sm:text-xl">
          AWS
        </span>
        <span class="text-sm leading-normal text-gray-400 sm:block">
          Detailed list of best practices for Amazon Web Services (AWS)
        </span>
      </a>
    </div>
  </div>
</div>
@endsection
