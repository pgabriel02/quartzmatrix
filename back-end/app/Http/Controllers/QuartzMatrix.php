<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class QuartzMatrix extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function getAngajati(Request $req) {
        $user['results'] = DB::select('SELECT * FROM `angajati` WHERE `nume` LIKE ? AND `prenume` LIKE ? AND `CNP` LIKE ? LIMIT ?, ?', ['%'.$req->nume.'%', '%'.$req->prenume.'%', '%'.$req->cnp.'%', $req->page*25, 25]);
        $user['total'] = DB::table('angajati')->count();
        return (
            $user
        );
   }
   public function getMedieDepartament(Request $req) {
        $medie['results'] = DB::select('SELECT departament.id AS "id", departament.nume AS "nume_departament" , avg(angajati.salariu) AS "medie_salariu" FROM `departament` LEFT JOIN `angajati` ON departament.id = angajati.id_departament WHERE departament.nume LIKE ? GROUP BY departament.id, departament.nume LIMIT ?, ?',
        ['%'.$req->numeDepartament.'%', $req->page*25, 25]);
        $medie['total'] = DB::table('mediedepartament')->count();
        return $medie;
    }
   public function getAngajatiDepartament(Request $req) {
        $medie['results'] = DB::select('SELECT angajati.id AS "id", angajati.nume AS "nume" , angajati.prenume AS "prenume", departament.nume AS "nume_departament", departament.descriere as "descriere_departament" FROM angajati inner join departament ON departament.id = angajati.id_departament
        WHERE angajati.nume LIKE ? AND angajati.prenume LIKE ? AND departament.nume LIKE ? AND departament.descriere LIKE ? GROUP BY angajati.id, angajati.nume, angajati.prenume, departament.nume, departament.descriere LIMIT ?, ?',
        ['%'.$req->nume.'%', '%'.$req->prenume.'%', '%'.$req->numeDepartament.'%', '%'.$req->descriereDepartament.'%', $req->page*25, 25]    
    );
        $medie['total'] = DB::table('angajatidepartament')->count();
        return $medie;
    }
}
