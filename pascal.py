def generate_pascals_triangle(num_rows):
    if num_rows <= 0:
        return []

    triangle = [[1]]  # Initialize the first row of the triangle

    for i in range(1, num_rows):
        row = [1]  # Start each row with a 1
        for j in range(1, i):
            # Each element is the sum of the two elements above it
            row.append(triangle[i-1][j-1] + triangle[i-1][j])
        row.append(1)  # End each row with a 1
        triangle.append(row)

    return triangle

# Example usage:
num_rows = 5
triangle = generate_pascals_triangle(num_rows)
for row in triangle:
    print(row)