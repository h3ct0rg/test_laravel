SELECT
    u.name,
    COUNT(t.id) as total_tareas,
    SUM(
        CASE
            WHEN t.estado = 'pendiente' THEN 1
            ELSE 0
        END
    ) AS tareas_pendientes,
    SUM(
        CASE
            WHEN t.estado = 'en_progreso' THEN 1
            ELSE 0
        END
    ) AS tareas_en_progreso,
    SUM(
        CASE
            WHEN t.estado = 'completada' THEN 1
            ELSE 0
        END
    ) AS tareas_completada
FROM users u
    LEFT JOIN tasks t ON t.user_id = u.id
GROUP BY
    u.id,
    u.name
ORDER BY u.name;