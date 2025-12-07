<h2>Add New Climb</h2>

<form action="/index.php?page=climb_add_do" method="post">
    <label>Climb Type:
        <select name="climb_type" required>
            <option>Boulder</option>
            <option>Sport</option>
            <option>Trad</option>
            <option>Gym Route</option>
        </select>
    </label><br><br>

    <label>Grade:
        <input type="text" name="grade" required>
    </label><br><br>

    <label>Attempts:
        <input type="number" name="attempts" min="1" value="1" required>
    </label><br><br>

    <button type="submit">Save Climb</button>
</form>
