<?php

	abstract class Estado {
		const EXITO = 1;
		const ERROR = 0;
	}

	abstract class Operacion {
		const CONSULTA = 0;
		const ALTA = 1;
		const MODIFICAR = 2;
		const BAJA = 3;

		const _MENSAJE = array("consulta", "alta", "modificar", "baja");
	}

	abstract class TipoError {
		const FK_JUGADOR_EQUIPO = 0;
		const ALTA_LIGA_NO_EXISTE = 1;
		const ALTA_EQUIPO_YA_EXISTE = 2;

		// TODO: Ajustar el tipo de error a algo con más sentido (demasiado genérico)
		const ERROR_DESCONOCIDO = 3;

		const _MENSAJE = array("No se puede borrar un equipo con jugadores en contrato.",
							   "No existe la liga donde se intenta asignar el equipo.",
							   "El equipo a dar de alta ya existe.",
							   "Se ha producido un error inesperado");
	}

?>