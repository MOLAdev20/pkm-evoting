import type { Metadata } from "next";
import { Topbar } from "../components/topbar";
import { Sidebar } from "../components/sidebar";
import { Card, CardContent } from "@/components/ui/card";

export const metadata: Metadata = {
  title: "Dashboard Pemilihan OSIS",
};

export default function Page() {
  return (
    <div className="flex min-h-screen">
      {/* Sidebar desktop */}
      <Sidebar selected="dashboard" />

      {/* Main */}
      <div className="flex min-w-0 flex-1 flex-col">
        <Topbar />

        <main className="flex-1 space-y-6 px-4 py-6 sm:px-6 lg:px-8">
          {/* METRIK UTAMA */}
          <section className="grid gap-4 md:grid-cols-3">
            {/* Total Pemilih */}
            <Card className="rounded-2xl border border-slate-100 shadow-sm">
              <CardContent className="flex flex-col gap-3 p-4">
                <div className="flex items-center justify-between">
                  <span className="text-xs font-medium text-slate-500">Total pemilih terdaftar</span>
                  <span className="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-700">
                    🎓 Siswa aktif
                  </span>
                </div>
                <div className="text-xl font-semibold tracking-tight">1.280 siswa</div>
                <p className="text-[11px] text-slate-400">Menggabungkan seluruh kelas X, XI, XII.</p>
              </CardContent>
            </Card>

            {/* Sudah Memilih */}
            <Card className="rounded-2xl border border-slate-100 shadow-sm">
              <CardContent className="flex flex-col gap-3 p-4">
                <div className="flex items-center justify-between">
                  <span className="text-xs font-medium text-slate-500">Sudah memberikan suara</span>
                  <span className="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] font-medium text-emerald-700">
                    ⬆ 18.2% hari ini
                  </span>
                </div>
                <div className="text-xl font-semibold tracking-tight">734 siswa</div>
                <div className="h-2 w-full overflow-hidden rounded-full bg-slate-100">
                  {/* 734/1280 ≈ 57% */}
                  <div className="h-full w-[57%] rounded-full bg-emerald-500" />
                </div>
                <p className="mt-1 text-[11px] text-slate-400">
                  Partisipasi sementara: <span className="font-semibold text-emerald-600">57%</span>
                </p>
              </CardContent>
            </Card>

            {/* Sisa Pemilih */}
            <Card className="rounded-2xl border border-slate-100 shadow-sm">
              <CardContent className="flex flex-col gap-3 p-4">
                <div className="flex items-center justify-between">
                  <span className="text-xs font-medium text-slate-500">Belum memilih</span>
                  <span className="inline-flex items-center gap-1 rounded-full bg-amber-50 px-2 py-0.5 text-[11px] font-medium text-amber-700">
                    ⏰ Ingatkan kelas
                  </span>
                </div>
                <div className="text-xl font-semibold tracking-tight">546 siswa</div>
                <div className="mt-1 flex flex-wrap gap-1 text-[11px] text-slate-500">
                  <span className="inline-flex items-center rounded-full bg-slate-50 px-2 py-0.5">Kelas X: 210</span>
                  <span className="inline-flex items-center rounded-full bg-slate-50 px-2 py-0.5">Kelas XI: 172</span>
                  <span className="inline-flex items-center rounded-full bg-slate-50 px-2 py-0.5">Kelas XII: 164</span>
                </div>
              </CardContent>
            </Card>
          </section>

          {/* CHART + KANDIDAT */}
          <section className="grid gap-4 lg:grid-cols-3">
            {/* Progress Partisipasi */}
            <Card className="lg:col-span-2 rounded-2xl border border-slate-100 shadow-sm">
              <CardContent className="flex flex-col gap-4 p-4">
                <div className="flex items-center justify-between gap-3">
                  <div>
                    <h2 className="text-sm font-semibold text-slate-900">Progress partisipasi pemilih</h2>
                    <p className="text-xs text-slate-400">Trend 7 hari menjelang pemungutan suara</p>
                  </div>
                  <select className="rounded-xl border border-slate-200 bg-slate-50 px-2.5 py-1 text-[11px] text-slate-600 outline-none">
                    <option>7 hari terakhir</option>
                    <option>Hari ini</option>
                    <option>Minggu ini</option>
                  </select>
                </div>

                {/* Placeholder chart tanpa gradient */}
                <div className="relative mt-1 h-52 overflow-hidden rounded-xl border border-slate-100 bg-white">
                  {/* grid garis */}
                  <div className="absolute inset-3">
                    <div className="grid h-full w-full grid-cols-12 grid-rows-4">
                      <div className="border-t border-dashed border-slate-100" />
                      <div className="border-t border-dashed border-slate-100" />
                      <div className="border-t border-dashed border-slate-100" />
                      <div className="border-t border-dashed border-slate-100" />
                    </div>
                  </div>

                  <svg className="absolute inset-4 h-[calc(100%-2rem)] w-[calc(100%-2rem)]">
                    {/* Realisasi */}
                    <path
                      d="M0 130 C 40 110, 80 120, 120 95 S 200 80, 260 70 S 320 60, 380 55"
                      fill="none"
                      stroke="#38BDF8"
                      strokeWidth="2.5"
                      strokeLinecap="round"
                    />
                    {/* Target */}
                    <path
                      d="M0 150 C 40 140, 80 135, 120 130 S 200 120, 260 115 S 320 110, 380 108"
                      fill="none"
                      stroke="#A5B4FC"
                      strokeWidth="2"
                      strokeLinecap="round"
                      strokeDasharray="4 4"
                    />
                    <circle cx="320" cy="60" r="5" fill="#38BDF8" />
                    <circle cx="260" cy="115" r="4" fill="#A5B4FC" />
                  </svg>

                  <div className="absolute bottom-3 left-4 flex items-center gap-3 text-[11px] text-slate-500">
                    <span className="inline-flex items-center gap-1">
                      <span className="h-2 w-2 rounded-full bg-sky-400" />
                      Realisasi
                    </span>
                    <span className="inline-flex items-center gap-1">
                      <span className="h-2 w-2 rounded-full bg-indigo-300" />
                      Target
                    </span>
                  </div>
                </div>
              </CardContent>
            </Card>

            {/* Distribusi suara kandidat + Pengumuman */}
            <div className="space-y-3">
              {/* Distribusi */}
              <Card className="rounded-2xl border border-slate-100 shadow-sm">
                <CardContent className="space-y-3 p-4">
                  <div className="flex items-center justify-between">
                    <h3 className="text-sm font-semibold text-slate-900">Distribusi suara kandidat</h3>
                    <span className="text-[11px] text-slate-400">Data sementara</span>
                  </div>

                  <div className="flex flex-col gap-3 text-xs">
                    {/* A */}
                    <div className="flex items-center gap-3">
                      <div className="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-50 text-[11px] font-semibold text-emerald-700">
                        A
                      </div>
                      <div className="flex-1">
                        <div className="flex items-center justify-between">
                          <span className="font-medium text-slate-800">Kandidat A</span>
                          <span className="text-slate-500">42%</span>
                        </div>
                        <div className="mt-1 h-1.5 overflow-hidden rounded-full bg-slate-100">
                          <div className="h-full w-[42%] rounded-full bg-emerald-400" />
                        </div>
                      </div>
                    </div>

                    {/* B */}
                    <div className="flex items-center gap-3">
                      <div className="flex h-8 w-8 items-center justify-center rounded-full bg-sky-50 text-[11px] font-semibold text-sky-700">
                        B
                      </div>
                      <div className="flex-1">
                        <div className="flex items-center justify-between">
                          <span className="font-medium text-slate-800">Kandidat B</span>
                          <span className="text-slate-500">35%</span>
                        </div>
                        <div className="mt-1 h-1.5 overflow-hidden rounded-full bg-slate-100">
                          <div className="h-full w-[35%] rounded-full bg-sky-400" />
                        </div>
                      </div>
                    </div>

                    {/* C */}
                    <div className="flex items-center gap-3">
                      <div className="flex h-8 w-8 items-center justify-center rounded-full bg-violet-50 text-[11px] font-semibold text-violet-700">
                        C
                      </div>
                      <div className="flex-1">
                        <div className="flex items-center justify-between">
                          <span className="font-medium text-slate-800">Kandidat C</span>
                          <span className="text-slate-500">23%</span>
                        </div>
                        <div className="mt-1 h-1.5 overflow-hidden rounded-full bg-slate-100">
                          <div className="h-full w-[23%] rounded-full bg-violet-400" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <p className="text-[11px] text-slate-400">
                    Angka di atas simulasi. Di produksi, isi dari API perhitungan real-time.
                  </p>
                </CardContent>
              </Card>

              {/* Pengumuman (tanpa gradient) */}
              <Card className="rounded-2xl border border-slate-100 shadow-sm">
                <CardContent className="p-4">
                  <p className="text-xs font-medium text-slate-500">Pengumuman penting</p>
                  <p className="mt-1 text-sm font-semibold tracking-tight text-slate-900">
                    Batas akhir pemungutan suara: 12.30 WIB
                  </p>
                  <p className="mt-1 text-[11px] text-slate-500">
                    Pastikan semua kelas sudah diarahkan ke ruang voting sebelum jam tersebut.
                  </p>
                  <button className="mt-3 inline-flex items-center rounded-full border border-slate-200 bg-white px-3 py-1 text-[11px] font-medium text-slate-700 hover:bg-slate-50">
                    Lihat detail jadwal →
                  </button>
                </CardContent>
              </Card>
            </div>
          </section>

          {/* TAHAPAN & AKTIVITAS */}
          <section className="grid gap-4 xl:grid-cols-3">
            {/* Tahapan */}
            <Card className="rounded-2xl border border-slate-100 shadow-sm xl:col-span-1">
              <CardContent className="space-y-4 p-4">
                <div className="flex items-center justify-between">
                  <h2 className="text-sm font-semibold text-slate-900">Tahapan pemilihan</h2>
                  <span className="text-[11px] text-slate-400">Timeline</span>
                </div>

                <ol className="space-y-3 text-xs">
                  <li className="flex items-start gap-3">
                    <div className="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-50 text-[11px] text-emerald-700">
                      1
                    </div>
                    <div className="flex-1">
                      <div className="flex items-center justify-between gap-2">
                        <p className="font-semibold text-slate-800">Pendaftaran kandidat</p>
                        <span className="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-medium text-emerald-700">
                          Selesai
                        </span>
                      </div>
                      <p className="text-[11px] text-slate-400">01–05 Oktober 2025</p>
                    </div>
                  </li>

                  <li className="flex items-start gap-3">
                    <div className="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-sky-50 text-[11px] text-sky-700">
                      2
                    </div>
                    <div className="flex-1">
                      <div className="flex items-center justify-between gap-2">
                        <p className="font-semibold text-slate-800">Masa kampanye</p>
                        <span className="inline-flex items-center rounded-full bg-sky-50 px-2 py-0.5 text-[10px] font-medium text-sky-700">
                          Berjalan
                        </span>
                      </div>
                      <p className="text-[11px] text-slate-400">06–10 Oktober 2025</p>
                    </div>
                  </li>

                  <li className="flex items-start gap-3">
                    <div className="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-violet-50 text-[11px] text-violet-700">
                      3
                    </div>
                    <div className="flex-1">
                      <div className="flex items-center justify-between gap-2">
                        <p className="font-semibold text-slate-800">Pemungutan suara</p>
                        <span className="inline-flex items-center rounded-full bg-amber-50 px-2 py-0.5 text-[10px] font-medium text-amber-700">
                          Jadwal berikutnya
                        </span>
                      </div>
                      <p className="text-[11px] text-slate-400">11 Oktober 2025</p>
                    </div>
                  </li>

                  <li className="flex items-start gap-3">
                    <div className="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-slate-100 text-[11px] text-slate-600">
                      4
                    </div>
                    <div className="flex-1">
                      <div className="flex items-center justify-between gap-2">
                        <p className="font-semibold text-slate-800">Pengumuman ketua terpilih</p>
                        <span className="inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-medium text-slate-600">
                          Menunggu
                        </span>
                      </div>
                      <p className="text-[11px] text-slate-400">12 Oktober 2025</p>
                    </div>
                  </li>
                </ol>
              </CardContent>
            </Card>

            {/* Aktivitas terbaru */}
            <Card className="overflow-hidden rounded-2xl border border-slate-100 shadow-sm xl:col-span-2">
              <div className="flex items-center justify-between border-b border-slate-100 px-4 py-3">
                <div>
                  <h2 className="text-sm font-semibold text-slate-900">Aktivitas terbaru</h2>
                  <p className="text-xs text-slate-400">Log singkat pemungutan suara & perubahan data</p>
                </div>
                <div className="flex items-center gap-2">
                  <button className="hidden items-center rounded-xl border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs text-slate-600 transition hover:bg-slate-100 sm:inline-flex">
                    Unduh log
                  </button>
                  <button className="inline-flex items-center rounded-xl bg-slate-900 px-3 py-1.5 text-xs font-medium text-white transition hover:bg-slate-800">
                    Filter
                  </button>
                </div>
              </div>

              <div className="overflow-x-auto">
                <table className="min-w-full text-left text-xs">
                  <thead className="bg-slate-50/80 text-[11px] uppercase tracking-wide text-slate-400">
                    <tr>
                      <th className="px-4 py-2">Waktu</th>
                      <th className="px-3 py-2">Jenis aktivitas</th>
                      <th className="px-3 py-2">Pelaku</th>
                      <th className="px-3 py-2">Detail</th>
                      <th className="px-3 py-2 text-right">Status</th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-slate-100 text-[13px]">
                    <tr className="transition hover:bg-slate-50/60">
                      <td className="px-4 py-3 text-slate-500">
                        10:12 <span className="text-[11px] text-slate-400">WIB</span>
                      </td>
                      <td className="px-3 py-3">
                        <span className="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-medium text-emerald-700">
                          Suara masuk
                        </span>
                      </td>
                      <td className="px-3 py-3 text-slate-700">NIS 2023.001</td>
                      <td className="px-3 py-3 text-slate-700">
                        Memilih kandidat A melalui perangkat ruang XI IPA 1
                      </td>
                      <td className="px-3 py-3 text-right font-medium text-emerald-600">Berhasil</td>
                    </tr>

                    <tr className="transition hover:bg-slate-50/60">
                      <td className="px-4 py-3 text-slate-500">
                        09:58 <span className="text-[11px] text-slate-400">WIB</span>
                      </td>
                      <td className="px-3 py-3">
                        <span className="inline-flex items-center rounded-full bg-sky-50 px-2.5 py-0.5 text-[11px] font-medium text-sky-700">
                          Update data
                        </span>
                      </td>
                      <td className="px-3 py-3 text-slate-700">Panitia - Rudi</td>
                      <td className="px-3 py-3 text-slate-700">
                        Mengubah nama kandidat B sesuai ejaan terbaru
                      </td>
                      <td className="px-3 py-3 text-right font-medium text-sky-600">Tercatat</td>
                    </tr>

                    <tr className="transition hover:bg-slate-50/60">
                      <td className="px-4 py-3 text-slate-500">
                        09:40 <span className="text-[11px] text-slate-400">WIB</span>
                      </td>
                      <td className="px-3 py-3">
                        <span className="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-[11px] font-medium text-amber-700">
                          Percobaan login
                        </span>
                      </td>
                      <td className="px-3 py-3 text-slate-700">NIS 2022.341</td>
                      <td className="px-3 py-3 text-slate-700">
                        Gagal login karena NIS tidak terdaftar sebagai pemilih
                      </td>
                      <td className="px-3 py-3 text-right font-medium text-amber-600">Ditolak</td>
                    </tr>

                    <tr className="transition hover:bg-slate-50/60">
                      <td className="px-4 py-3 text-slate-500">
                        09:25 <span className="text-[11px] text-slate-400">WIB</span>
                      </td>
                      <td className="px-3 py-3">
                        <span className="inline-flex items-center rounded-full bg-rose-50 px-2.5 py-0.5 text-[11px] font-medium text-rose-700">
                          Pembatalan suara
                        </span>
                      </td>
                      <td className="px-3 py-3 text-slate-700">Panitia - Sinta</td>
                      <td className="px-3 py-3 text-slate-700">
                        Reset pilihan siswa yang salah login ke akun temannya
                      </td>
                      <td className="px-3 py-3 text-right font-medium text-rose-600">Diverifikasi</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div className="flex items-center justify-between border-t border-slate-100 px-4 py-3 text-[11px] text-slate-500">
                <span>Menampilkan 1–4 dari 32 aktivitas terakhir</span>
                <div className="inline-flex items-center gap-1">
                  <button className="rounded-lg border border-slate-200 bg-white px-2 py-1 hover:bg-slate-50">
                    &larr; Sebelumnya
                  </button>
                  <button className="rounded-lg border border-slate-900 bg-slate-900 px-3 py-1 font-medium text-white">
                    1
                  </button>
                  <button className="rounded-lg border border-slate-200 bg-white px-3 py-1 hover:bg-slate-50">
                    2
                  </button>
                  <button className="rounded-lg border border-slate-200 bg-white px-3 py-1 hover:bg-slate-50">
                    3
                  </button>
                  <button className="rounded-lg border border-slate-200 bg-white px-2 py-1 hover:bg-slate-50">
                    Berikutnya &rarr;
                  </button>
                </div>
              </div>
            </Card>
          </section>
        </main>
      </div>
    </div>
  );
}
