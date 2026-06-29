<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class ProblemController extends Controller
{
    public function index(): View
    {
        // Later: replace with Problem::query()->withCount('acceptedSubmissions')->get().
        $problems = $this->problems();

        return view('problems.index', compact('problems'));
    }

    public function show(string $code): View
    {
        $problem = collect($this->problems())->firstWhere('code', strtoupper($code)) ?? $this->problems()[0];
        $languages = config('judge0.languages');
        $pastSubmissions = $this->submissionsForProblem($problem['code']);
        $hasAcceptedSubmission = $pastSubmissions->contains(fn (Submission $submission): bool => $submission->isAccepted());

        return view('problems.show', compact(
            'problem',
            'languages',
            'pastSubmissions',
            'hasAcceptedSubmission'
        ));
    }

    private function problems(): array
    {
        $starters = $this->starterCodes();

        return [
            [
                'code' => 'NJ101',
                'title' => 'Neon Array Balance',
                'difficulty' => 'Easy',
                'rating' => 900,
                'solved' => 124,
                'tags' => ['array', 'prefix sum'],
                'statement' => 'Given a sequence of integers, calculate the sum of all values.',
                'input_format' => 'The first line contains n. The second line contains n integers.',
                'output_format' => 'Print the sum of the integers.',
                'constraints' => "1 <= n <= 100000\n1 <= value <= 10^9",
                'sample_input' => "5\n1 2 3 4 5",
                'sample_output' => '15',
                'starter_code' => $starters['NJ101'],
            ],
            [
                'code' => 'NJ204',
                'title' => 'Campus Shortest Route',
                'difficulty' => 'Medium',
                'rating' => 1400,
                'solved' => 67,
                'tags' => ['graph', 'dijkstra'],
                'statement' => 'A campus has n buildings connected by m bidirectional roads. Find the minimum travel cost from a start building to a target building.',
                'input_format' => 'The first line contains n and m. Each of the next m lines contains u, v, and w. The last line contains s and t.',
                'output_format' => 'Print the shortest distance from s to t, or -1 if t cannot be reached.',
                'constraints' => "1 <= n <= 100000\n0 <= m <= 200000\n1 <= w <= 10^9",
                'sample_input' => "4 4\n1 2 3\n2 4 5\n1 3 2\n3 4 4\n1 4",
                'sample_output' => '6',
                'starter_code' => $starters['NJ204'],
            ],
            [
                'code' => 'NJ225',
                'title' => 'Tournament Pairing',
                'difficulty' => 'Medium',
                'rating' => 1500,
                'solved' => 52,
                'tags' => ['greedy', 'sorting'],
                'statement' => 'There are n players with rating values. Pair every player with exactly one other player so the total rating difference is as small as possible.',
                'input_format' => 'The first line contains an even integer n. The second line contains n player ratings.',
                'output_format' => 'Print the minimum possible total difference across all pairs.',
                'constraints' => "2 <= n <= 200000\nn is even\n1 <= rating <= 10^9",
                'sample_input' => "6\n10 30 20 40 90 100",
                'sample_output' => '30',
                'starter_code' => $starters['NJ225'],
            ],
            [
                'code' => 'NJ330',
                'title' => 'Crystal Maze Escape',
                'difficulty' => 'Hard',
                'rating' => 1900,
                'solved' => 21,
                'tags' => ['graph', 'bfs'],
                'statement' => 'You are inside a crystal maze. Cells contain open space, walls, one start cell S, and one exit cell E. Find the fewest moves needed to reach E.',
                'input_format' => 'The first line contains n and m. The next n lines contain the maze grid using S, E, ., and #.',
                'output_format' => 'Print the minimum number of moves, or -1 if the exit is unreachable.',
                'constraints' => "1 <= n, m <= 1000\nThere is exactly one S and one E",
                'sample_input' => "3 4\nS..#\n.#..\n..E.",
                'sample_output' => '4',
                'starter_code' => $starters['NJ330'],
            ],
            [
                'code' => 'NJ410',
                'title' => 'K-th Number Challenge',
                'difficulty' => 'Hard',
                'rating' => 2100,
                'solved' => 13,
                'tags' => ['binary search', 'math'],
                'statement' => 'Given n numbers and an integer k, find the k-th smallest number after sorting the list.',
                'input_format' => 'The first line contains n and k. The second line contains n integers.',
                'output_format' => 'Print the k-th smallest number.',
                'constraints' => "1 <= k <= n <= 200000\n-10^9 <= value <= 10^9",
                'sample_input' => "5 3\n9 1 7 3 5",
                'sample_output' => '5',
                'starter_code' => $starters['NJ410'],
            ],
        ];
    }

    private function submissionsForProblem(string $problem): Collection
    {
        if (! Auth::check()) {
            return collect();
        }

        try {
            return Submission::where('user_id', Auth::id())
                ->where('problem_code', strtoupper($problem))
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        } catch (Throwable) {
            return collect();
        }
    }

    private function starterCodes(): array
    {
        return [
            'NJ101' => <<<'CPP'
#include <bits/stdc++.h>
using namespace std;

int main() {
    ios::sync_with_stdio(false);
    cin.tie(nullptr);

    int n;
    cin >> n;

    long long sum = 0;
    for (int i = 0; i < n; i++) {
        long long value;
        cin >> value;
        sum += value;
    }

    cout << sum << '\n';
    return 0;
}
CPP,
            'NJ204' => <<<'CPP'
#include <bits/stdc++.h>
using namespace std;

int main() {
    ios::sync_with_stdio(false);
    cin.tie(nullptr);

    int n, m;
    cin >> n >> m;

    vector<vector<pair<int, int>>> graph(n + 1);
    for (int i = 0; i < m; i++) {
        int u, v, w;
        cin >> u >> v >> w;
        graph[u].push_back({v, w});
        graph[v].push_back({u, w});
    }

    int source, target;
    cin >> source >> target;

    const long long INF = 4e18;
    vector<long long> dist(n + 1, INF);
    priority_queue<pair<long long, int>, vector<pair<long long, int>>, greater<pair<long long, int>>> pq;

    dist[source] = 0;
    pq.push({0, source});

    while (!pq.empty()) {
        auto [cost, node] = pq.top();
        pq.pop();

        if (cost != dist[node]) continue;

        for (auto [next, weight] : graph[node]) {
            if (dist[next] > cost + weight) {
                dist[next] = cost + weight;
                pq.push({dist[next], next});
            }
        }
    }

    cout << (dist[target] == INF ? -1 : dist[target]) << '\n';
    return 0;
}
CPP,
            'NJ225' => <<<'CPP'
#include <bits/stdc++.h>
using namespace std;

int main() {
    ios::sync_with_stdio(false);
    cin.tie(nullptr);

    int n;
    cin >> n;

    vector<long long> rating(n);
    for (long long &value : rating) {
        cin >> value;
    }

    sort(rating.begin(), rating.end());

    long long answer = 0;
    for (int i = 0; i < n; i += 2) {
        answer += rating[i + 1] - rating[i];
    }

    cout << answer << '\n';
    return 0;
}
CPP,
            'NJ330' => <<<'CPP'
#include <bits/stdc++.h>
using namespace std;

int main() {
    ios::sync_with_stdio(false);
    cin.tie(nullptr);

    int n, m;
    cin >> n >> m;

    vector<string> grid(n);
    pair<int, int> start{-1, -1};

    for (int r = 0; r < n; r++) {
        cin >> grid[r];
        for (int c = 0; c < m; c++) {
            if (grid[r][c] == 'S') {
                start = {r, c};
            }
        }
    }

    vector<vector<int>> dist(n, vector<int>(m, -1));
    queue<pair<int, int>> q;
    q.push(start);
    dist[start.first][start.second] = 0;

    int dr[4] = {1, -1, 0, 0};
    int dc[4] = {0, 0, 1, -1};

    while (!q.empty()) {
        auto [r, c] = q.front();
        q.pop();

        if (grid[r][c] == 'E') {
            cout << dist[r][c] << '\n';
            return 0;
        }

        for (int i = 0; i < 4; i++) {
            int nr = r + dr[i];
            int nc = c + dc[i];

            if (nr < 0 || nc < 0 || nr >= n || nc >= m) continue;
            if (grid[nr][nc] == '#' || dist[nr][nc] != -1) continue;

            dist[nr][nc] = dist[r][c] + 1;
            q.push({nr, nc});
        }
    }

    cout << -1 << '\n';
    return 0;
}
CPP,
            'NJ410' => <<<'CPP'
#include <bits/stdc++.h>
using namespace std;

int main() {
    ios::sync_with_stdio(false);
    cin.tie(nullptr);

    int n, k;
    cin >> n >> k;

    vector<long long> values(n);
    for (long long &value : values) {
        cin >> value;
    }

    sort(values.begin(), values.end());
    cout << values[k - 1] << '\n';
    return 0;
}
CPP,
        ];
    }
}
