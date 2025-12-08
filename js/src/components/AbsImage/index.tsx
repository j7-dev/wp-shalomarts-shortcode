import React, { FC } from 'react'
import { MapIcon } from '@/components'
import { MAP_DATA } from '@/utils'
import { TMapData } from '@/types'
import { useAtomValue } from 'jotai'
import { selectedDataAtom } from '@/pages/atom';

export const AbsImage: FC<{
	className: string,
	width: number,
	top: number,
	left: number,
}> = ({
	className,
	width = 20,
	top = 0,
	left = 0,
}) => {
		const data = MAP_DATA.find(item => item.building === className)
		const maps = (data?.maps || []) as TMapData['maps']
		const includeIds = maps.map(item => item.postId)
		const selectedData = useAtomValue(selectedDataAtom);
		const isImageSelected = selectedData.postId !== 0 && includeIds.includes(selectedData.postId) && selectedData.selectAll;

		return (
			<div className={`sh-abs-image ${className} ${isImageSelected ? 'sh-hovered' : ''}`} style={{
				width: `${width}%`,
				top: `${top}%`,
				left: `${left}%`,
			}}>
				{maps.map(({ postId, top, left }) => (
					<MapIcon
						key={`${postId}${top}${left}`}
						postId={postId}
						top={top}
						left={left}
					/>
				))}
			</div>
		)
	}
