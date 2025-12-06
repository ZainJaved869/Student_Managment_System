@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Admin Panel -->
<div class="panel-content active" id="admin-panel">
    <!-- Dashboard Cards -->
    <div class="dashboard-cards">
        <div class="card card-students">
            <div class="card-header">
                <div>
                    <div class="card-stats">{{ $stats['total_students'] }}</div>
                    <div class="card-title">Total Students</div>
                </div>
                <div class="card-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>
        <!-- Other cards -->
    </div>

    <!-- Recent Students -->
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Recent Students</h2>
            <a href="{{ route('students.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Student
            </a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Parent</th>
                        <th>Contact</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentStudents as $student)
                    <tr>
                        <td>{{ $student->student_id }}</td>
                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->section }}</td>
                        <td>{{ $student->parent_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>
                            <span class="badge badge-{{ $student->status == 'active' ? 'success' : 'warning' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn" style="padding: 5px;">
                                <i class="fas fa-edit text-primary"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="padding: 5px;" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Other panels (Student, Staff, Parent) -->
@endsection