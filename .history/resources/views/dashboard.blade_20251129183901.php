@extends('layouts.app')

@section('title', 'Dashboard - DevShare Hub')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Welcome back, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-600 mt-2">Here's what's happening with your projects today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Projects</p>
                    <p class="text-2xl font-bold text-gray-800">{{ Auth::user()->projects()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-folder text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Downloads</p>
                    <p class="text-2xl font-bold text-gray-800">{{ Auth::user()->projects()->sum('download_count') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-download text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Views</p>
                    <p class="text-2xl font-bold text-gray-800">{{ Auth::user()->projects()->sum('view_count') }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Approved Projects</p>
                    <p class="text-2xl font-bold text-gray-800">{{ Auth::user()->projects()->where('is_approved', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Recent Projects -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('projects.create') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:bg-blue-50 transition duration-300 group">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition duration-300">
                        <i class="fas fa-cloud-upload-alt text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Upload New Project</p>
                        <p class="text-sm text-gray-600">Share your work with the community</p>
                    </div>
                </a>

                <a href="{{ route('projects.my-projects') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:border-green-300 hover:bg-green-50 transition duration-300 group">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition duration-300">
                        <i class="fas fa-folder text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Manage Projects</p>
                        <p class="text-sm text-gray-600">View and edit your uploaded projects</p>
                    </div>
                </a>

                <a href="{{ route('projects.index') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:border-purple-300 hover:bg-purple-50 transition duration-300 group">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition duration-300">
                        <i class="fas fa-rocket text-purple-600"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Browse Projects</p>
                        <p class="text-sm text-gray-600">Discover amazing projects from others</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Recent Projects</h3>
                <a href="{{ route('projects.my-projects') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
            </div>
            
            @php
                $recentProjects = Auth::user()->projects()->latest()->take(5)->get();
            @endphp

            @if($recentProjects->count() > 0)
                <div class="space-y-3">
                    @foreach($recentProjects as $project)
                        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition duration-300">
                            <div class="flex items-center space-x-3">
                                <img src="{{ $project->thumbnail_url }}" alt="{{ $project->title }}" class="w-10 h-10 rounded-lg object-cover">
                                <div>
                                    <p class="font-medium text-gray-800">{{ Str::limit($project->title, 30) }}</p>
                                    <p class="text-sm text-gray-500">
                                        {{ $project->download_count }} downloads • 
                                        <span class="{{ $project->is_approved ? 'text-green-600' : 'text-yellow-600' }}">
                                            {{ $project->is_approved ? 'Approved' : 'Pending' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('projects.show', $project->slug) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-folder-open text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500 mb-4">You haven't uploaded any projects yet</p>
                    <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        Upload Your First Project
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection