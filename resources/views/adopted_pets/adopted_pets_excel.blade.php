<!DOCTYPE html>
<html>
<head>
    <title>Adopted Pets</title>
</head>
<body>
    <h1>Adopted Pets</h1>
    <table>
        <thead>
            <tr>
                <th>Pet Name</th>
                <th>Breed</th>
                <th>Sex</th>
                <th>Date of Birth</th>
                <th>Description</th>
                <th>Adopter Name</th>
                <th>Adopter Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adoptedPets as $adoption)
                <tr>
                    <td>{{ $adoption->pet->name }}</td>
                    <td>{{ $adoption->pet->breed }}</td>
                    <td>{{ ucfirst($adoption->pet->sex) }}</td>
                    <td>{{ $adoption->pet->dob }}</td>
                    <td>{{ $adoption->pet->description }}</td>
                    <td>{{ $adoption->user->name }}</td>
                    <td>{{ $adoption->user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>