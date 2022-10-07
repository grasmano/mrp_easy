<div>
    <h5>2. SQL Last versions</h5>
    <pre>
    SELECT t.id, t.version, t.content FROM test_table t
    INNER JOIN (
        SELECT id, MAX(version) version
        FROM test_table
        GROUP BY id
    ) b ON t.id = b.id AND t.version = b.version;
    </pre>
</div>