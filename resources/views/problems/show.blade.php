@extends('layouts.app')

@section('title', $problem['title'].' | NeonJudge')

@section('content')
<section class="page-header">
    <p class="eyebrow">{{ $problem['code'] }}</p>
    <h1>{{ $problem['title'] }}</h1>
    <p class="muted">Difficulty {{ $problem['difficulty'] }} | Rating {{ $problem['rating'] }} | Solved {{ $problem['solved'] }}</p>
    <a class="btn btn-primary" href="{{ route('submissions.create', $problem['code']) }}">Submit Solution</a>
</section>

<section class="section problem-statement">
    <h2>Problem Statement</h2>
    <p>Given a sequence of integers, calculate the sum of all values. Your solution should read the input efficiently and print one integer.</p>

    <h2>Input Format</h2>
    <p>The first line contains an integer n. The second line contains n integers.</p>

    <h2>Output Format</h2>
    <p>Print the calculated result for the given sequence.</p>

    <h2>Constraints</h2>
    <pre>1 <= n <= 100000
1 <= value <= 10^9</pre>

    <h2>Sample Input</h2>
    <pre>5
1 2 3 4 5</pre>

    <h2>Sample Output</h2>
    <pre>15</pre>
</section>
@endsection
