<?php

use yii\db\Migration;

class m240101_000001_create_diagnosis_tables extends Migration
{
    public function safeUp()
    {
        // Tabel Gejala (Symptom)
        $this->createTable('symptom', [
            'id' => $this->primaryKey(),
            'code' => $this->string(5)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'weight' => $this->decimal(3,2)->notNull(),
            'category' => $this->string(20)->notNull(),
            'min_value' => $this->decimal(3,2)->notNull(),
            'max_value' => $this->decimal(3,2)->notNull(),
            'created_at' => $this->timestamp(),
        ]);

        // Insert data gejala
        $symptoms = [
            ['G01', 'Nyeri Pada Perut', 0.15, 'Ringan', 0.0, 0.4],
            ['G02', 'Mual dan Muntah', 0.15, 'Ringan', 0.0, 0.4],
            ['G03', 'Mual dan Tidak Muntah', 0.15, 'Ringan', 0.0, 0.4],
            ['G04', 'Sering Buang Air Besar', 0.15, 'Ringan', 0.0, 0.4],
            ['G05', 'Perut Kembung', 0.15, 'Ringan', 0.0, 0.4],
            ['G06', 'Nyeri Ulu Hati', 0.8, 'Parah', 0.6, 1.0],
            ['G07', 'Kram Perut', 0.5, 'Sedang', 0.3, 0.7],
            ['G08', 'Sakit Kepala', 0.15, 'Ringan', 0.0, 0.4],
            ['G09', 'Nyeri Tekan Pada Perut', 0.8, 'Parah', 0.6, 1.0],
            ['G10', 'Tubuh Lemah', 0.5, 'Sedang', 0.3, 0.7],
            ['G11', 'Nyeri Perut seperti di Tusuk-tusuk', 0.8, 'Parah', 0.6, 1.0],
            ['G12', 'Panas Pada Perut', 0.15, 'Ringan', 0.0, 0.4],
            ['G13', 'Demam', 0.15, 'Ringan', 0.0, 0.4],
            ['G14', 'Nyeri Saat Buang Air Besar', 0.5, 'Sedang', 0.3, 0.7],
            ['G15', 'Dada terasa panas', 0.15, 'Ringan', 0.0, 0.4],
            ['G16', 'Muntah Berwarna Kehijauan', 0.5, 'Sedang', 0.3, 0.7],
            ['G17', 'Perut Perih dan Panas', 0.5, 'Sedang', 0.3, 0.7],
            ['G18', 'Nyeri Perut Bawah', 0.5, 'Sedang', 0.3, 0.7],
            ['G19', 'Demam Tinggi', 0.5, 'Sedang', 0.3, 0.7],
            ['G20', 'Nyeri Perut Kiri Bawah', 0.5, 'Sedang', 0.3, 0.7],
            ['G21', 'Nyeri Perut Kanan Bawah', 0.8, 'Parah', 0.6, 1.0],
            ['G22', 'Nyeri Tumpul Pada Perut', 0.8, 'Parah', 0.6, 1.0],
            ['G23', 'Demam Meningkat Secara Bertahap', 0.8, 'Parah', 0.6, 1.0],
            ['G24', 'Muntah Menyembur Keluar Melalui hidung dan Mulut', 0.8, 'Parah', 0.6, 1.0],
            ['G25', 'Nyeri Tulang', 0.8, 'Parah', 0.6, 1.0],
            ['G26', 'Sakit dan Nyeri Seperti Teriris', 0.8, 'Parah', 0.6, 1.0],
            ['G27', 'Tinja Cair', 0.15, 'Ringan', 0.0, 0.4],
            ['G28', 'Anemia (kurang darah)', 0.8, 'Parah', 0.6, 1.0],
            ['G29', 'Tekanan Darah Rendah', 0.5, 'Sedang', 0.3, 0.7],
            ['G30', 'Nyeri Menjalar ke Punggung', 0.15, 'Ringan', 0.0, 0.4],
            ['G31', 'Pecandu Rokok dan Alkohol', 0.15, 'Ringan', 0.0, 0.4],
            ['G32', 'Rasa Perut Kosong dan Lapar', 0.15, 'Ringan', 0.0, 0.4],
            ['G33', 'Tinja Keras', 0.8, 'Parah', 0.6, 1.0],
            ['G34', 'Wajah Kebiruan', 0.5, 'Sedang', 0.3, 0.7],
            ['G35', 'Tinja Berlendir dan Berdarah', 0.8, 'Parah', 0.6, 1.0],
            ['G36', 'Sulit Buang Air Besar', 0.5, 'Sedang', 0.3, 0.7],
            ['G37', 'Lidah Terlihat Putih Kotor', 0.15, 'Ringan', 0.0, 0.4],
            ['G38', 'Berat Badannya Menurun', 0.15, 'Ringan', 0.0, 0.4],
            ['G39', 'Tinja Berwarna Kehitaman', 0.8, 'Parah', 0.6, 1.0],
            ['G40', 'Dinding Perut Tebal dan Kaku', 0.8, 'Parah', 0.6, 1.0],
            ['G41', 'Tinja Cair Lalu Berdarah selama 1-8 Hari', 0.8, 'Parah', 0.6, 1.0],
            ['G42', 'Perut Terasa Perih Setelah Makan', 0.5, 'Sedang', 0.3, 0.7],
            ['G43', 'Makan Dapat Menimbulkan Nyeri', 0.15, 'Ringan', 0.0, 0.4],
            ['G44', 'Sakit Saat Buang Air Besar', 0.8, 'Parah', 0.6, 1.0],
            ['G45', 'Muntah Seperti di Sengaja', 0.5, 'Sedang', 0.3, 0.7],
            ['G46', 'Tinja Berwarna Kemerahan', 0.5, 'Sedang', 0.3, 0.7],
            ['G47', 'Nyeri di Bagian Tengah Perut', 0.5, 'Sedang', 0.3, 0.7],
            ['G48', 'Tinja Cair dan Berlendir', 0.15, 'Ringan', 0.0, 0.4],
            ['G49', 'Mencret-mencret', 0.15, 'Ringan', 0.0, 0.4],
            ['G50', 'Makan Dapat Mengurangi Nyeri', 0.15, 'Ringan', 0.0, 0.4],
            ['G51', 'Nyeri Perut Kanan', 0.5, 'Sedang', 0.3, 0.7],
            ['G52', 'Tinja Berlendir', 0.5, 'Sedang', 0.3, 0.7],
            ['G53', 'Terus-menerus merasa haus', 0.5, 'Sedang', 0.0, 0.4],
        ];

        foreach ($symptoms as $symptom) {
            $this->insert('symptom', [
                'code' => $symptom[0],
                'name' => $symptom[1],
                'weight' => $symptom[2],
                'category' => $symptom[3],
                'min_value' => $symptom[4],
                'max_value' => $symptom[5],
            ]);
        }

        // Tabel Penyakit
        $this->createTable('disease', [
            'id' => $this->primaryKey(),
            'code' => $this->string(5)->notNull()->unique(),
            'name' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'treatment' => $this->text(),
            'created_at' => $this->timestamp(),
        ]);

        $diseases = [
            ['P01', 'Apendistis', 'Peradangan pada usus buntu'],
            ['P02', 'Peritonitis', 'Peradangan selaput rongga perut'],
            ['P03', 'Demam Tifoid', 'Infeksi bakteri Salmonella typhi'],
            ['P04', 'Entritis', 'Peradangan usus halus'],
            ['P05', 'Stenosis Pilorus', 'Penyempitan saluran antara lambung dan usus'],
            ['P06', 'Duodenitis', 'Peradangan pada usus dua belas jari'],
            ['P07', 'Karsinoma Lambung', 'Kanker lambung'],
            ['P08', 'Kolitis Crohn', 'Peradangan kronis saluran pencernaan'],
            ['P09', 'Pencernaan Lemah', 'Gangguan fungsi pencernaan'],
            ['P10', 'Kolitis Hemoragika', 'Peradangan usus besar dengan perdarahan'],
            ['P11', 'Ulkus Peptikum', 'Luka pada lambung atau usus'],
            ['P12', 'Rufluk Empedu', 'Aliran balik empedu'],
            ['P13', 'Ulkus Duodenum', 'Luka pada usus dua belas jari'],
            ['P14', 'Ulkus Gastrikum', 'Luka pada lambung'],
            ['P15', 'Gastroentitis', 'Peradangan lambung dan usus'],
            ['P16', 'Ileus', 'Hambatan pada usus'],
            ['P17', 'Penyakit Corhn', 'Penyakit autoimun pencernaan'],
            ['P18', 'Bulimia Nevorsa', 'Gangguan makan psikologis'],
            ['P19', 'Disentri Basilar', 'Infeksi usus dengan diare berdarah'],
            ['P20', 'Divertikulitis', 'Peradangan kantong pada dinding usus'],
        ];

        foreach ($diseases as $disease) {
            $this->insert('disease', [
                'code' => $disease[0],
                'name' => $disease[1],
                'description' => $disease[2],
            ]);
        }

        // Tabel Aturan
        $this->createTable('rule', [
            'id' => $this->primaryKey(),
            'disease_id' => $this->integer()->notNull(),
            'symptom_code' => $this->string(5)->notNull(),
            'created_at' => $this->timestamp(),
        ]);

        // Mapping kode penyakit ke ID (gunakan query langsung)
        $diseaseIds = [];
        foreach ($diseases as $disease) {
            $row = (new \yii\db\Query())
                ->select('id')
                ->from('disease')
                ->where(['code' => $disease[0]])
                ->one();
            if ($row) {
                $diseaseIds[$disease[0]] = $row['id'];
            }
        }

        $rules = [
            'P01' => ['G01','G02','G09','G21','G36'],
            'P02' => ['G01','G02','G13','G22','G28','G53'],
            'P03' => ['G01','G02','G10','G23','G27','G37'],
            'P04' => ['G01','G02','G04','G10','G29'],
            'P05' => ['G01','G02','G24','G38','G53'],
            'P06' => ['G01','G03','G05','G11','G47','G49'],
            'P07' => ['G01','G03','G11','G25','G39'],
            'P08' => ['G01','G03','G09','G11','G13','G40'],
            'P09' => ['G01','G03','G04','G12','G48'],
            'P10' => ['G01','G03','G07','G26','G41'],
            'P11' => ['G01','G02','G15','G30','G42'],
            'P12' => ['G01','G02','G06','G16','G31'],
            'P13' => ['G01','G02','G17','G32','G50'],
            'P14' => ['G01','G02','G06','G17','G32','G43'],
            'P15' => ['G01','G02','G05','G07','G27'],
            'P16' => ['G01','G02','G05','G07','G33','G44'],
            'P17' => ['G01','G02','G07','G51','G52'],
            'P18' => ['G01','G02','G08','G18','G45'],
            'P19' => ['G01','G02','G19','G34','G46'],
            'P20' => ['G01','G02','G09','G20','G35'],
        ];

        foreach ($rules as $diseaseCode => $symptomCodes) {
            if (isset($diseaseIds[$diseaseCode])) {
                foreach ($symptomCodes as $symptomCode) {
                    $this->insert('rule', [
                        'disease_id' => $diseaseIds[$diseaseCode],
                        'symptom_code' => $symptomCode,
                    ]);
                }
            }
        }

        // Tabel History Diagnosis
        $this->createTable('diagnosis_history', [
            'id' => $this->primaryKey(),
            'patient_name' => $this->string(100),
            'patient_age' => $this->integer(),
            'selected_symptoms' => $this->text(),
            'diagnosis_result' => $this->string(100),
            'severity_percentage' => $this->decimal(5,2),
            'severity_category' => $this->string(20),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('diagnosis_history');
        $this->dropTable('rule');
        $this->dropTable('disease');
        $this->dropTable('symptom');
    }
}