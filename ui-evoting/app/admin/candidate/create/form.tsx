"use client";

import { Label } from "@radix-ui/react-label";
import { Input } from "@/components/ui/input";
import { FormEvent } from "react";
import Axios from "axios";
import swal from "sweetalert2"

const handleSubmit = (e:FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    const formData = new FormData(e.currentTarget);
    const candidateName: string = formData.get("candidate-name") as string;
    const candidateClass: string = formData.get("candidate-class") as string;
    const candidateOrder: string = formData.get("candidate-order") as string;
    const candidateVision: string = formData.get("candidate-vision") as string;
    const candidateMission: string = formData.get("candidate-mission") as string;

    Axios.post(process.env.NEXT_PUBLIC_BACKEND_URL+"candidates/", {
        name: candidateName,
        photo: "default.jpg",
        class_name: candidateClass,
        order_number: Number(candidateOrder),
        vision: candidateVision,
        mission: candidateMission
    }).then((res) => {
        if (res.status == 200) {
            swal.fire({
                title: 'Berhasil',
                text: "Kandidat berhasil ditambahkan",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            })
        }

        // kosongkan semua field
    }).catch((err) => {
        console.log(err);
    });
}

export default function FormCandidate() {
  return (
    <form onSubmit={handleSubmit} className="overflow-x-auto">
      <div className="grid px-4 py-3 text-[11px] text-slate-500">
        <div className="mt-2">
          <Label>Nama Kandidat</Label>
          <Input name="candidate-name" required className="mt-1 text-sm" />
        </div>
        <div className="mt-2">
          <Label>Kelas</Label>
          <Input name="candidate-class" required className="mt-1 text-sm" />
        </div>
        <div className="mt-2">
          <Label>Nomor Urut</Label>
          <Input name="candidate-order" required className="mt-1 text-sm" />
        </div>
        <div className="mt-2">
          <Label>Visi</Label>
          <Input name="candidate-vision" required className="mt-1 text-sm" />
        </div>
        <div className="mt-2">
          <Label>Misi</Label>
          <Input name="candidate-mission" required className="mt-1 text-sm" />
        </div>
      </div>

      <div className="flex justify-end border-t border-slate-100 px-4 py-3">
        <button
          type="submit"
          className="rounded-lg bg-slate-800 px-4 py-2 text-sm font-semibold cursor-pointer active:bg-slate-700 active:transform active:scale-95 transition text-white"
        >
          Simpan
        </button>
      </div>
    </form>
  );
}
