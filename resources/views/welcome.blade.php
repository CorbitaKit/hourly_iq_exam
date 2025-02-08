<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg">
        <h4 class="text-center mb-3">Date Picker & Table</h4>

        <div class="d-flex gap-2 justify-content-center">
            <input type="date" class="form-control w-auto" id="dateInput">
            <button class="btn btn-primary" id="fetchButton">Submit</button>
        </div>

        <div class="table-responsive mt-3">
            <table class="table table-bordered text-center" >
                <thead class="table-dark">
                    <tr>
                        <th>Job Id</th>
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Customer Name</th>

                    </tr>
                </thead>
                <tbody id="jobTableBody">
                    @foreach ($occupations as $occupation)
                    <tr>
                        <td>{{$occupation->job_id}}</td>
                        <td>{{$occupation->invoice_number}}</td>
                        <td>{{$occupation->date}}</td>
                        <td>{{$occupation->total_amount}}</td>
                        <td>{{$occupation->customer_name}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('fetchButton').addEventListener('click', function () {
        const date = document.getElementById('dateInput').value;
        if (!date) {
            alert('Please select a date!');
            return;
        }

        fetch(`/get-jobs/${date}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('jobTableBody');
                tableBody.innerHTML = ''; // Clear existing rows

                if (data.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="3">No jobs found</td></tr>';
                    return;
                }

                data.forEach(job => {
                    tableBody.innerHTML += `
                        <tr>
                            <td>${job.job_id}</td>
                            <td>${job.invoice_number}</td>
                            <td>${job.date}</td>
                            <td>${job.total_amount}</td>
                            <td>${job.customer_name}</td>
                        </tr>
                    `;
                });
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to fetch jobs.');
            });
    });
    </script>
</body>
</html>
