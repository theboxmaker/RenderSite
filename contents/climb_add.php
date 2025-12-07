<h2>Add New Climb</h2>

<form action="/index.php?page=climb_add_do" method="post">
    <label>Climb Type:
        <select name="climb_type" required>
            <option value="">-- Select Type --</option>
            <option value="Boulder">Boulder</option>
            <option value="Sport">Sport</option>
            <option value="Top Rope">Top Rope</option>
            <option value="Trad">Trad</option>
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
